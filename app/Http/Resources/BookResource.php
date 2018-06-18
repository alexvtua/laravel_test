<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'type' => 'books',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'author' => [
                    'id' => $this->author_id,
                    'first_name' => $this->author->first_name,
                    'last_name' => $this->author->last_name,
                ]],
        ];
    }
}
