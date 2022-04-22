<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body',
    ];

    public function photo () {
        return $this->belongsTo(Photo::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }

   
}
