<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content'];

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
