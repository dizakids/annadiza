<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ArticleShow extends JsonResource
{

    public function toArray($request)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');

        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'author'     => $this->author,
            'text'     => $this->text,
            'body'      => $this->body,
            'status'      => $this->status,
            'home'      => $this->home,
            'image'     => $this->image,
            'created_at'=> $date,
            'tags'      => $this->tags,
            'category_id'      => $this->category_id,
        ];
    }
}
