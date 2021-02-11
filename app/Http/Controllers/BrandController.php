<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5); //get latest data on the top
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validatedData= $request->validate([ //default validation
            'brand_name' => 'required|unique:brands|min:4', //min 4 characters //message will be standart 
            'brand_image' => 'required|mimes:jpg,jpeg,png', //mimes means suported formats jpeg, png         
        ],
        [ 
            'brand_name.required' => 'Please Input Brand name', //custome message
            'brand_image.min' => 'Brand longer then 4 Characters', //custome message      
        ]);

        $brand_image = $request->file('brand_image'); //pass file (type from form), brand_image name from form //pass requeste image

        $name_gen = hexdec(uniqid()); //image name will be autogenerated id (digits)
        $img_ext = strtolower($brand_image->getClientOriginalExtension()); //take extensios name of uploaded image, for example if we wil upload .png extention will be png
        $img_name = $name_gen.'.'.$img_ext; //that means how image name looks added from two parts
        $up_location = 'image/brand/';  //image will be saved in public/image/brand/  (path till generated image name)
        $last_img =  $up_location.$img_name; //image will save in this location with unique name for example image/brand/1691250077451320.png
        $brand_image->move($up_location,$img_name); //move file to this locaton (folder) image/brand/ with file name $img_name

        Brand::insert([  //insert picture
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img, //insert into DB for example image/brand/1691250077451320.png
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}
