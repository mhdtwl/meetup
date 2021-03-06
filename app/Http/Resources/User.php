<?php

namespace App\Http\Resources;


class User extends AbstractResource
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
            'name' =>   $this->name,
            'email' =>  $this->email,
            'created_at' => $this->getCarbonCreatedAt($this->created_at)
        ];
    }
}
