<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "cover" => $this->cover,
            "read" => $this->read,
            "published" => $this->created_at->format('d M Y') ,
            "author" => $this->author->name,
            "category" => $this->category->name,
            "author_id" => $this->author_id,
            "cat_id" => $this->category_id,
        ];
    }
}
