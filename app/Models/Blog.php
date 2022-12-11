<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public static $blog, $image, $imgUrl, $imgName, $directory, $str;
    public static function  saveBlog($request){
        self::$blog = new Blog();
        self::$blog->category_id = $request->category_id;
        self::$blog->author_id = $request->author_id;
        self::$blog->title = $request->title;
        self::$blog->slug = self::makeSlug($request);
        self::$blog->description = $request->description;
        self::$blog->image = self::saveImage($request);
        self::$blog->date = $request->date;
        self::$blog->blog_type = $request->blog_type;
        self::$blog->status = $request->status;
        self::$blog->save();
    }
    public static function saveImage($request){
        self::$image = $request->file('image');
        self::$imgName = rand().".".self::$image->extension();
        self::$directory = 'admin/upload-image/blog-image/';
        self::$imgUrl = self::$directory.self::$imgName;
        self::$image->move(self::$directory, self::$imgName);
        return self::$imgUrl;
    }
    public static function makeSlug($request){
        if($request->slug){
            self::$str = $request->slug;
            return preg_replace('/\s+/u', '-', trim(self::$str));
        }
        self::$str = $request->title;
        return preg_replace('/\s+/u', '-', trim(self::$str));
    }
}
