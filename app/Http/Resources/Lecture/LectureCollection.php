<?php

namespace App\Http\Resources\Lecture;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Lecture */
class LectureCollection extends ResourceCollection
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
