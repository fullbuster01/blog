<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['category_id', 'user_id', 'thumbnail', 'title', 'slug', 'body'];

    protected $with = ['category', 'tags', 'user'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // ini relasi many to many untuk tabel post_tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function takeImage(){
        return "/storage/" . $this->thumbnail;
    }


}
