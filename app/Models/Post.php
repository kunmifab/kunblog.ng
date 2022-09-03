<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this -> belongsTo(Category::class);
    }

    public function author() {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function tags () {
        return $this -> belongsToMany(Tag::class);
    }

    public function comments () {
        return $this -> hasMany(Comment::class);
    }

    public function notification () {
        return $this -> hasOne(Notification::class);
    }

}
