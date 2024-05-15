<?php

namespace App\Http\Controllers;


use App\Domains\User\Models\User;
use App\Domains\User\Repositories\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(CreateUserRequest $request): JsonResponse
    {
        (new UserRepository())->create($request);
        return response()->json([], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $login = (new UserRepository())->login(
            $request->input('email'),
            $request->input('password')
        );

        if (empty($login)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($login);
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        (new UserRepository())->logout($user);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
