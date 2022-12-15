<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        return view('admin.blog.add-blog', [
            'categories'=>Category::all(), 'authors'=>Author::all()
        ]);
    }
    public function saveBlog(Request $request){
        Blog::saveBlog($request);
        return redirect(route('manage.blog'));
    }
    public function manageBlog(){
        return view('admin.blog.manage-blog', [
            'blogs'=> DB::table('blogs')
                          ->join('categories', 'categories.id', '=', 'blogs.category_id')
                          ->join('authors', 'authors.id', '=', 'blogs.author_id')
                          ->select('blogs.*', 'categories.category_name', 'authors.author_name')
                          ->get()
        ]);
    }
    public function editBlog(Request $request){
        return view('admin.blog.edit-blog',[
            'blog'=> Blog::find($request->blog_id),
            'categories'=> Category::where('status', 1)->get(),
            'authors'=> Author::all()
        ]);
    }
    public function status($blogId){
        $blog = Blog::find($blogId);
        if($blog->status == 0){
            $blog->status = 1;
        } else $blog->status = 0;
        $blog->save();
        return back();

    }
    public function deleteBlog(Request $request){
        $blog = Blog::find($request->blog_id);
        if($blog->image){
            if (file_exists($blog->image)){
                unlink($blog->image);
            }
        }
        $blog->delete();
        return back();
    }
}
