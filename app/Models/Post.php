<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{ 
    protected $fillable = ['post_title','post_summary'];

    public function comments(){
        return $this-> hasMany(Comment::class);
    }
}
