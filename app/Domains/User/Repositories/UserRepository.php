<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Models\User;
use App\Http\Requests\CreateUserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function login(string $email, string $password): array
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken($email, ['*'], Carbon::now()->addMinutes(30));
            return ['token' => $token->plainTextToken];
        }

        return [];
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }

    public function create(CreateUserRequest $request): void
    {
        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    }
}
