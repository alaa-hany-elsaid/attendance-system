<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return array_merge([
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'role'        => $this->role,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            //            'lectures_count'             => $this->lectures_count,
            //            'subjects_count'             => $this->subjects_count,
        ], $this->pivot && isset($this->pivot->attended) ? [
            'attended' => (bool) $this->pivot->attended ,
        ] : []);
    }
}
