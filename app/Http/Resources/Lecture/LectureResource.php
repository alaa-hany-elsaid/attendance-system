<?php

namespace App\Http\Resources\Lecture;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Lecture */
class LectureResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'title'       => $this->title,
            'abstraction' => $this->abstraction,
            'subject_id'  => $this->subject_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
