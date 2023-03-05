<?php


namespace App\Helpers;

use Illuminate\Http\JsonResponse;

trait Response
{


    public function responseWithModelNotFound($name): JsonResponse
    {
        return response()->json([
            'message' => $name . ' Not found.',
        ], 404);
    }


    public function responseWithSuccessfulDeleted($name): JsonResponse
    {
        return response()->json([
            'message' => $name . ' deleted successfully',
        ]);
    }

    public function responseWithActionDoneSuccessfully($message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ]);
    }

}
