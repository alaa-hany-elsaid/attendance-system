<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminSubjectRequest;
use App\Http\Requests\Admin\Subject\UpdateFinalGradeRequest;
use App\Http\Resources\Lecture\LectureCollection;
use App\Http\Resources\Subject\SubjectCollection;
use App\Http\Resources\Subject\SubjectResource;
use App\Models\Subject;
use App\Models\User;

class AdminSubjectController extends Controller
{

    use Response;

    public function index()
    {
        return new SubjectCollection(Subject::all());
    }


    public function view(Subject $subject)
    {

        return new SubjectResource($subject);
    }

    public function getLectures(Subject $subject)
    {
        return new LectureCollection($subject->lectures);
    }

    public function updateFinalGrade(UpdateFinalGradeRequest $request, Subject $subject, User $user)
    {
        if (! $user->isStudent()) return $this->responseWithModelNotFound('Student');
        $subject->students()->syncWithoutDetaching([
            $user->id => [
                'final_grade' => $request->get('final_grade'),
            ],
        ]);
        return $this->responseWithActionDoneSuccessfully('update final grade successfully');

    }
}