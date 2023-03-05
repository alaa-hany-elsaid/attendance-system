<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminStudentController extends Controller
{

    use  Response ;
    public function index()
    {
        return new UserCollection(User::students());
    }


    public function view(User $user)
    {

        return $user->isStudent() ? new UserResource($user) : $this->responseWithModelNotFound('Student');

    }
}