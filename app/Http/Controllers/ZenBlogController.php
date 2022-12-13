<?php

namespace App\Http\Controllers;

use App\Models\BlogUser;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ZenBlogController extends Controller
{
    public function index() {
        return view('frontEnd.home.home', [
            'blogs'=> DB::table('blogs')
                          ->join('categories', 'categories.id', 'blogs.category_id')
                          ->join('authors', 'authors.id', 'blogs.author_id')
                          ->select('blogs.*', 'categories.category_name', 'authors.author_name')
                          ->where('blogs.status', 1)
                          ->where('blogs.blog_type', 'popular')
                          ->orderBy('id', 'desc')
                          ->skip(1)
                          ->take(4)
                          ->get()
        ]);
    }
    public function postDetail($slug) {
        $blog = DB::table('blogs')
            ->join('categories', 'categories.id', 'blogs.category_id')
            ->join('authors', 'authors.id', 'blogs.author_id')
            ->select('blogs.*', 'categories.category_name', 'authors.author_name')
            ->where('blogs.slug', $slug)
            ->first();
        return view('frontEnd.single-post.single-post', [
            'blog'=>$blog,
            'categoryWiseBlogs' => DB::table('blogs')
                ->join('categories', 'categories.id', 'blogs.category_id')
                ->join('authors', 'authors.id', 'blogs.author_id')
                ->select('blogs.*', 'categories.category_name', 'authors.author_name')
                ->where('blogs.category_id', $blog->category_id)
                ->get()
        ]);
    }
    public function blogCategory($catId) {
        return view('frontEnd.category.category', [
            'categoryWiseBlogs' => DB::table('blogs')
                ->join('categories', 'categories.id', 'blogs.category_id')
                ->join('authors', 'authors.id', 'blogs.author_id')
                ->select('blogs.*', 'categories.category_name', 'authors.author_name','authors.author_image')
                ->where('blogs.category_id', $catId)
                ->where('blogs.status', 1)
                ->get(),
            'category' => Category::find($catId)
        ]);
    }
    public function about() {
        return view('frontEnd.about.about');
    }
    public function contact() {
        return view('frontEnd.contact.contact');
    }
    public function userLogin() {
        return view('frontEnd.auth.login');
    }
    public function userLogout() {
        Session::forget('userId');
        Session::forget('userName');
        return redirect('/');
    }
    public function userRegister() {
        return view('frontEnd.auth.register');
    }
    public function saveUser(Request $request) {
        BlogUser::saveUser($request);
        return back();

    }
    public function checkLoginUser(Request $request) {
        $userInfo = BlogUser::where('email', $request->user_name)
                            ->orWhere('phone', $request->user_name)
                            ->first();
        if($userInfo) {
            if(password_verify($request->password, $userInfo->password)){
                Session::put('userId', $userInfo->id);
                Session::put('userName', $userInfo->name);
                return redirect('/');
            } else return back()->with('errPass', 'Please enter valid password');

        }else return back()->with('errName', 'Please use valid username');

    }
}
