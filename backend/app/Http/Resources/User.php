<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{

    public function toArray($request)
    {

        $tags = [];
        foreach($this->tags as $tag){
            $tags[] = $tag->id;
        }

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'age'               => $this->age,
            'gender'            => $this->gender,
            'post_code'         => $this->post_code,
            'prefecture_code'   => $this->prefecture_code,
            'address'           => $this->address,
            'admin'             => $this->admin,
            'tags'              => $tags,
        ];
    }


}
