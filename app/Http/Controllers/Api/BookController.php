<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @var array
     */
    private $sortable = [
        'title',
        'authors.first_name',
        'authors.last_name'
    ];

    /**
     * @var string
     */
    private $defaultSort = 'title';

    /**
     * @var array
     */
    private $possibleDirection = [
        'asc',
        'desc'
    ];

    /**
     * @var string
     */
    private $defaultDirection = 'ASC';

    /**
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        BookResource::withoutWrapping();

        return new BookResource($book);
    }

    /**
     * @param Request $request
     * @return BooksResource
     */
    public function index(Request $request)
    {
        $sortBy = $request->input('sort');
        $sortBy = in_array($sortBy, $this->sortable) ? $sortBy : $this->defaultSort;

        $direction = $request->input('direction');
        $direction = in_array($direction, $this->possibleDirection) ? $direction : $this->defaultDirection;

        return new BooksResource(BooksResource::collection(
            Book::join('authors', 'authors.id', '=', 'books.author_id')->orderBy($sortBy, $direction)
                ->select('books.id', 'title', 'author_id', 'first_name', 'last_name')->paginate()
        ));
    }
}
