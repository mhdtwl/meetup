<?php

namespace App\Http\Resources;


class Group extends AbstractResource
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
            'id' => $this->id,
            'name' =>  $this->name,
            'type' =>  $this->type,
            'created_at' => $this->getCarbonCreatedAt($this->created_at)
        ];
    }
}
