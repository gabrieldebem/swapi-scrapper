<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     *     tags={"Users"},
     *     path="/users",
     *     summary="Create a new user",
     *     description="Create a new authenticable user",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="name", type="string", description="Name of the user"),
     *         @OA\Property(property="email", type="string", description="Email of the user"),
     *         @OA\Property(property="password", type="string", description="Password of the user"),
     *       ),
     *     ),
     *     @OA\Response(
     *       response=201,
     *       description="User created",
     *   ),
     * )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json($user, 201);
    }

    /**
     * @param AuthUserRequest $request
     * @return JsonResponse
     * @throws Exception
     *
     * @OA\Post(
     *     tags={"Users"},
     *     path="/users/auth",
     *     summary="Authenticate a user",
     *     description="Authenticate a user",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="email", type="string", description="Email of the user"),
     *         @OA\Property(property="password", type="string", description="Password of the user"),
     *       ),
     *     ),
     *     @OA\Response(response=200, description="User authenticated"),
     * )
     */
    public function auth(AuthUserRequest $request): JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw new Exception('Invalid credentials', 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken($request->input('device'))->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/users/me",
     *     summary="Get current user",
     *     description="Get current user",
     *     security={{"BearerAuth":{}}},
     *     @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *   ),
     * )
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
