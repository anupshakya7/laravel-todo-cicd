<?php

namespace App\Models;

use App\Models\Scopes\PostDetailScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected static function booted(){
        // static::addGlobalScope('postDetail',function(Builder $builder){
        //     $builder->with('user:id,name','categories:id,name');
        // });
        static::addGlobalScope(new PostDetailScope);
    }

    public function scopeActive($query,$values=true){
        return $query->whereStatus($values);
    }

    // public function scopePostDetail($query){
    //     return $query->with('user:id,name','categories:id,name');
    // } 

    public function categories(){
        return $this->belongsToMany(Category::class,'categories_posts','post_id','category_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
