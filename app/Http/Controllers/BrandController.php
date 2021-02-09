<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand(){

        $brands = Brand::latest()->paginate(5); //get latest data on the top
        return view('admin.brand.index', compact('brands'));
    }
}
