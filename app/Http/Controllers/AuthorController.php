<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        return view('admin.author.author', ['authors'=>Author::all()]);
    }
    public function saveAuthor(Request $request){
        Author::saveAuthor($request);
        return redirect(route('author'));
    }
    public function editAuthor(Request $request){
        return view('admin.author.edit-author', ['author'=>Author::find($request->author_id)]);
    }

}
