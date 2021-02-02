<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCategory(){
      // $categories = Category::all(); //get all data with category model
      //$categories = Category::latest()->get(); // latest data will showed in the top

      //creating using query-builder

      $categories = DB::table('categories')->latest()->get();


       return view('admin.category.index', compact('categories')); //compact pass all data to view
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

    
    // another method how to insert data

    // $category = new Category; //new object for category model
    // $category->category_name = $request->category_name ; //with new object  $category we access database field name and it should match with requested category_name from blade input name
    // $category->user_id = Auth::user()->id; //math with Authenticated user id
    // $category->save();

    //$data = array();
    //$data['category_name'] = $request->category_name;    //$data['category_name'] - database field  //  = $request->category_name  requested field 
    //$data['user_id'] = Auth::user()->id; 

    //DB::table('categories')->insert($data);  //insert all array data
        
    return Redirect()->back()->with('success','Category inserted succesfully' );   //when will be inserted it wil redirect to backpage // with ('success', ) means what kind of message we want to see

    }
}
