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
      $categories = Category::latest()->paginate(5); // for pagination

      $trashCat =Category::onlyTrashed()->latest()->paginate(3); //there will trach data

      //creating using query-builder

     // $categories = DB::table('categories')->latest()->get();

     // $categories = DB::table('categories')->latest()->paginate(5);  //instead get() we use paginate()

    //   $categories = DB::table('categories')
    //     ->join('users','categories.user_id', 'users.id' )
    //     ->select('categories.*','users.name') //select * from categories, and name prom users
    //     ->latest()->paginate(5); //show latest on top with pagination

       return view('admin.category.index', compact('categories', 'trashCat' )); //compact pass all data to view // variable trahCat will show in index page
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
        
    return Redirect()->back()->with('success','Category Inserted succesfully' );   //when will be inserted it wil redirect to backpage // with ('success', ) means what kind of message we want to see

    }

    public function Edit($id){
        //$categories = Category::find($id); //we will take date from db with this specific id
        $categories = DB::table('categories')->where('id', $id )->first();  //id from db match with $id in function argument //first() to load a specific data in query buider
        return view('admin.category.edit', compact('categories')); //to pass data to view of specific one id
    }

    public function Update(Request $request, $id){  //Request $request means whatever request i pass throught the form 
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,   //$request->category_name we pass request name from form
        //     'user_id' => Auth::user()->id
        // ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data); //update($data) we pass data array to update
        return Redirect()->route('all.category')->with('success','Category Updated succesfully');        

    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Delete Successfully');

    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();  // withTrashed() will find a specific data id and then restore this data
        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function Pdelete($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete(); //delete forever
        return Redirect()->back()->with('success', 'Category Permanently Deleted');
    }



}
