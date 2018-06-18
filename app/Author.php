<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * Get the books for the Author.
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
