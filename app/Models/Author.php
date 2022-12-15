<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public static $author, $image, $imgName, $directory, $imgUrl;
    public static function saveAuthor($request){
        if($request->author_id){
            self::$author = Author::find($request->author_id);
        } else {
            self::$author = new Author();
        }
        self::$author->author_name = $request->author_name;
        if($request->file('author_image')){
            if($request->author_id){
                if(file_exists(self::$author->author_image)){
                    unlink(self::$author->author_image);
                }
            }
            self::$author->author_image = self::saveImage($request);
        }
        self::$author->save();
    }
    public static function saveImage($request){
        self::$image = $request->file('author_image');
        self::$imgName = rand().".".self::$image->extension();
        self::$directory = 'admin/upload-image/author-image/';
        self::$imgUrl = self::$directory.self::$imgName;
        self::$image->move(self::$directory, self::$imgName);
        return self::$imgUrl;
    }
    public static function updateAuthor($request){
        self::$author = Author::find($request->author_id);
        if(self::$author->author_image){
            if(file_exists(self::$author->author_image)){
                unlink(self::$author->author_image);
            }
        }
        self::$author->author_name = $request->author_name;
        self::$author->author_image = self::saveImage($request);
        self::$author->save();
    }
}
