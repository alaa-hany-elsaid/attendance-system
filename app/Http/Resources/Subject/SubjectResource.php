<?php

namespace App\Http\Resources\Subject;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subject */
class SubjectResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'total_grade'         => $this->total_grade,
            'attendance_grade'    => $this->attendance_grade,
            'project_grade'       => $this->project_grade,
            'midterm_grade'       => $this->midterm_grade,
            'final_grade'         => $this->final_grade,
            'every_lecture_grade' => $this->every_lecture_grade,
            'lectures_number'     => $this->lectures_number,
            'professor'           => new UserResource($this->professor),
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
        ];
    }
}
