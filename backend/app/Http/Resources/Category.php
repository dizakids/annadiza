<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'        => $this->id,
            'name'     => $this->name,
            'path'     => $this->path,
            'description'     => $this->description,
            'status'      => $this->status,
            'menu'      => $this->menu,
            'parent_id'      => $this->parent_id,

        ];
    }



}
