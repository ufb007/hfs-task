<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(protected UserRepository $userRepository)
    {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $this->userRepository->create($request->all());

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
    
            $user = Auth::user();
    
            $token = $user->createToken('userToken')->plainTextToken;

            return response()->json([
                'token' => $token,
                'message' => 'User created successfully'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            Gate::authorize('update', $user);

            $editedUser = $this->userRepository->update($user, $request->all());

            return response()->json([
                'message' => 'User updated successfully',
                'user' => UserResource::collection(new Collection([$editedUser]))
            ], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
