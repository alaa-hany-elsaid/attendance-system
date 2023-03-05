<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Subject\SubjectCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentProfessorController extends Controller
{
    public function index()
    {
        return new UserCollection(User::professors());
    }

    public function view(User $user)
    {
        if (!$user->isProfessor())
            throw  new ModelNotFoundException();
        return new UserResource($user);
    }

    public function getSubjects(User $user)
    {
        return new SubjectCollection($user->subjects);
    }
}