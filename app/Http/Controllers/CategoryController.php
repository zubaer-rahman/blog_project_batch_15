<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.category', ['categories'=> Category::all()]);
    }
    public function saveCategory(Request $request){
        Category::saveCategory($request);
        return back();
    }
    public function deleteCategory(Request $request){
         Category::find($request->catId)->delete();
         return back();
    }


}
