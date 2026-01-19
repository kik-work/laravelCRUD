<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','comment_text','comment_reactions'];
    protected $hidden = ['post_id'];

    public function post(){
        return $this-> belongsTo(Post::class);
    }

}
