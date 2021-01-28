<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory(){
       return view('admin.category.index');
    }

    public function AddCategory(Request $request){
        $validatedData= $request->validate([ //default validation
            'category_name' => 'bail|required|unique:categories|max:255', //unique only category table            
        ],
        [ 
            'category_name.required' => 'Please enter category name', //my customise message when fies is required   
            'category_name.max' => 'Categoty Less Them 255 characters', //my customise message when character is more then 255 characters       
        ],

    );
    }
}
