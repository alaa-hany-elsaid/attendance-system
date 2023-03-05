<?php

namespace App\Http\Controllers\API\Professor;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Lecture\UpdateAttendanceStateRequest;
use App\Http\Resources\Lecture\LectureCollection;
use App\Http\Resources\User\UserCollection;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\User;

class ProfessorLectureController extends Controller
{

    use Response;

    public function index(Subject $subject)
    {
        return new LectureCollection($subject->lectures);
    }


    public function getAllStudents(Lecture $lecture)
    {


        $lecture->attendantStudents()->syncWithoutDetaching($lecture->subject->students()
            ->whereNotIn('id', $lecture->attendantStudents()->get(['id'])->map(fn($student) => $student->id)->toArray())
            ->get(['id'])
            ->map(fn($student) => $student->id)
            ->flip()
            ->map(fn($val) => ['attended' => false]));


        return new UserCollection($lecture->attendantStudents()->withPivot('attended')->get());


        //     $lecture->attendantStudents()->syncWithoutDetaching()

    }

    public function getAllAttendants(Lecture $lecture)
    {

        return new UserCollection($lecture->attendantStudents()
            ->withPivot('attended')
            ->wherePivot('attended', true)
            ->get());

    }

    public function updateAttendance(UpdateAttendanceStateRequest $request, Lecture $lecture, User $user)
    {
        if (!$user->isStudent()) return $this->responseWithModelNotFound('Student');
        $lecture->attendantStudents()->syncWithoutDetaching([
            $user->id => [
                'attended' => $request->get('attended'),
            ],
        ]);
        return $this->responseWithActionDoneSuccessfully('Update attendance state successfully');
    }
}