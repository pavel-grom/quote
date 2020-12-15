<?php

namespace App\Http\Controllers;

use App\Models\User;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatController extends Controller
{
    public function totalCount(Responder $responder): SuccessResponseBuilder
    {
        return $responder->success([
            'count' => (int) Cache::get('api-total-requests', 0)
        ]);
    }

    public function myCount(Request $request, Responder $responder): SuccessResponseBuilder
    {
        /** @var User $user */
        $user = $request->user();

        return $responder->success([
            'count' => (int) Cache::get("api:users:{$user->id}", 0)
        ]);
    }
}
