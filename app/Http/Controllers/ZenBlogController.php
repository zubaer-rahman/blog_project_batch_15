<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function category() {
        return view('frontEnd.category.category');
    }
    public function about() {
        return view('frontEnd.about.about');
    }
    public function contact() {
        return view('frontEnd.contact.contact');
    }
}
