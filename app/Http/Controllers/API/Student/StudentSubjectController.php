<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lecture\LectureCollection;
use App\Http\Resources\Subject\SubjectCollection;
use App\Http\Resources\Subject\SubjectResource;
use App\Models\Subject;

class StudentSubjectController extends Controller
{
    public function index()
    {
        return new SubjectCollection(auth()->user()->subjects);
    }


    public  function  view(Subject $subject){

        return new SubjectResource($subject);
    }
    public function getLectures(Subject $subject)
    {

        return new LectureCollection($subject->lectures);

    }


    public function getResult(Subject $subject)
    {

        return response()->json(['result' => 0]);

    }


}