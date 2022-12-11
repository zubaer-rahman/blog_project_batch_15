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
        return back();
    }
    public function editAuthor(Request $request){
        return view('admin.author.edit-author', ['author'=>Author::find($request->author_id)]);
    }
    public function updateAuthor(Request $request){
        Author::updateAuthor($request);
        return back();
    }
}
