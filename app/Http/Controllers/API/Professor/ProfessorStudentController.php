<?php

namespace App\Http\Controllers\API\Professor;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Subject\UpdateStudentGradeRequest;
use App\Http\Resources\User\UserCollection;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfessorStudentController extends Controller
{
    use Response;

    public function getStudents(Subject $subject)
    {
        return new UserCollection($subject->students);
    }

    public function getResultOfSubject(Subject $subject, User $user)
    {
        if (! $user->isStudent()) return $this->responseWithModelNotFound('Student');
        $result = $subject->students()->wherePivot('user_id' , $user->id , )->withPivot(['attendance_grade' , 'project_grade' , 'final_grade' , 'midterm_grade' ])->first()->pivot->toArray() ;
        $result['student_id'] = $result['user_id'];
        unset($result['user_id']);
        return response()->json(['result' => $result]);
    }

    public function updateResultOfSubject(UpdateStudentGradeRequest $request ,  Subject $subject, User $user)
    {
        if (! $user->isStudent()) return $this->responseWithModelNotFound('Student');
        $subject->students()->syncWithoutDetaching([
            $user->id => $request->getValidatedValuesWithoutNulls(),
        ]);
        return $this->responseWithActionDoneSuccessfully('result updated successfully');
    }


}