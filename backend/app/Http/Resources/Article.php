<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Article extends JsonResource
{

    public function toArray($request)
    {

        $tags = [];
        foreach($this->tags as $tag){
            $tags[] = $tag->id;
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');

        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'author'     => $this->author,
            'text'     => $this->text,
            'status'      => $this->status,
            'home'      => $this->home,
            'body'      => $this->body,
            'image'     => $this->image,
            'created_at'=> $date,
            'tags'      => $tags,
            //'category_id'      => $category_id,
        ];
    }

}
