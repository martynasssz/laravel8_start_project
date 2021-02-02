<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function AllCategory(){
       return view('admin.category.index');
    }

    public function AddCategory(Request $request){
        $validatedData= $request->validate([ //default validation
            'category_name' => 'bail|required|unique:categories|max:255', //unique only category table  //message will be standart          
        ],
        [ 
            'category_name.required' => 'Please enter category name', //my customise message when fieds is required   
            'category_name.max' => 'Categoty Less Them 255 characters', //my customise message when character is more then 255 characters       
        ]
    );

    //elequent method

    Category::insert([
        'category_name' => $request->category_name, //first database fiels  //$request function // name passed from DB name="category_name"
        'user_id' => Auth::user()->id, //access only login user id  => means add //id will be taken this user who logged in
        'created_at' => Carbon::now() //will be inserted carbon format

    ]);

    return Redirect()->back()->with('success','Category inserted succesfully' );   //when will be inserted it wil redirect to backpage // with ('success', ) means what kind of message we want to see

    // query bilder method

    // $category = new Category; //new object for category model
    // $category->category_name = $request->category_name ; //with new object  $category we access database field name and it should match with requested category_name from blade input name
    // $category->user_id = Auth::user()->id; //math with Authenticated user id
    // $category->save();


    }
}
