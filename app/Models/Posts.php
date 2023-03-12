<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    //Relationship for username and user_id function
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
