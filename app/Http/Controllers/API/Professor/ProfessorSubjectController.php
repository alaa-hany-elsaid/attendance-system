<?php

namespace App\Http\Controllers\API\Professor;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\ProfessorSubjectRequest;
use App\Http\Requests\Professor\Subject\UpdateSubjectGradesRequest;
use App\Http\Resources\Subject\SubjectCollection;
use App\Http\Resources\Subject\SubjectResource;
use App\Models\Subject;

class ProfessorSubjectController extends Controller
{

    use Response;

    public function index()
    {
        return new SubjectCollection(auth()->user()->subjects);
    }

    public function view(Subject $subject)
    {
        return new SubjectResource($subject);
    }


    public function update(UpdateSubjectGradesRequest $request, Subject $subject)
    {


        $subject->update($request->getValidatedValuesWithoutNulls());
        return $this->responseWithActionDoneSuccessfully('grades updated successfully');
    }


}