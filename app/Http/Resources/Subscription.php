<?php

namespace App\Http\Resources;

use App\Http\Resources\Group as GroupResource;
use App\Http\Resources\User as UserResource;


class Subscription extends AbstractResource
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
            'id' => $this->id, //PostResource::collection($this->whenLoaded('posts')),
            'status' => $this->status,
            'created_at' => $this->getCarbonCreatedAt($this->created_at),
            'user' =>    new UserResource($this->user),
            'group' =>  new GroupResource($this->group),
            'invitedBy' =>   new UserResource($this->invited_by),
        ];
    }
}
