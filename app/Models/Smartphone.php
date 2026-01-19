<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Smartphone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'smartphones'; 
    protected $hidden = ['user_id'];
    protected $fillable = ['user_id','name', 'brand', 'ram', 'price'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
