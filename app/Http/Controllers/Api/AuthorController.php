<?php

namespace App\Http\Controllers\Api;

use App\Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorsResource;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Author $author
     * @return AuthorResource
     */
    public function show(Author $author)
    {
        AuthorResource::withoutWrapping();

        return new AuthorResource($author);
    }

    /**
     * @return AuthorsResource
     */
    public function index()
    {
        return new AuthorsResource(AuthorsResource::collection(Author::all()));
    }
}
