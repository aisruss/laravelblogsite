<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class BlogComments extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submitted_by()
    {
        return $this->belongsTo(User::class);
    }


}
