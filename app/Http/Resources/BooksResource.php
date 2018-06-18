<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BooksResource extends Resource
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
            'data' => $this->collection->transform(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'link' => route('books.show', [$book->id]),
                    'author' => [
                        'id' => $book->author->id,
                        'first_name' => $book->author->first_name,
                        'last_name' => $book->author->last_name,
                        'link' => route('authors.show', [$book->author->id])
                    ],
                ];
            }),
            'pagination' => [
                'total' => $this->resource->total(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'next_page_url' => $this->resource->nextPageUrl(),
                'prev_page_url' => $this->resource->previousPageUrl(),
                'from' => $this->resource->firstItem(),
                'to' => $this->resource->lastItem(),
            ]
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('books.index'),
            ],
        ];
    }
}
