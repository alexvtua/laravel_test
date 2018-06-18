<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\Resource;

class AuthorsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($author){
                return [
                    'id' => $author->id,
                    'first_name' => $author->first_name,
                    'last_name' => $author->last_name,
                    'books' => $author->books->transform(function($book){
                        return [
                            'id' => $book->id,
                            'title' => $book->title,
                            'link' => route('books.show', [$book->id])
                        ];
                    }),
                ];
            }),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('books.index'),
            ],
        ];
    }
}
