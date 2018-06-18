<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Get the Author that owns the comment.
     */
    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }
}
