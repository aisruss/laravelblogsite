<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'content', 'author_id' ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function blogComments()
    {
        return $this->hasMany(BlogComments::class);
    }

}
