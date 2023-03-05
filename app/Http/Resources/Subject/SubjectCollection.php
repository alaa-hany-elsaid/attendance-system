<?php

namespace App\Http\Resources\Subject;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Subject */
class SubjectCollection extends ResourceCollection
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
