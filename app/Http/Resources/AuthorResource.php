<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AuthorResource extends Resource
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
            'type' => 'author',
            'id' => (string)$this->id,
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'books' => $this->books->transform(function ($book) {
                    return [
                        'id' => $book->id,
                        'title' => $book->title
                    ];
                }),
            ],
            'date' => $this->created_at->diffForHumans()
        ];
    }
}
