<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="User Management API",
 *      description="API documentation for managing users"
 * )
 * @OA\Tag(
 *     name="User management",
 *     description="APIs for managing users"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Use a token to authenticate requests",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth",
 * )
 */
class UserController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get all users
     *
     * @OA\Get(
     *     path="/api/v1/users",
     *     tags={"User management"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        $users = auth()->user();
        return $this->success($users);
    }

    /**
     * Create a new user
     *
     * @OA\Post(
     *     path="/api/v1/users",
     *     tags={"User management"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *     required={"email", "password", "full_name", "photo_url"},
     *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *     @OA\Property(property="password", type="string", format="password", example="password123"),
     *     @OA\Property(property="full_name", type="string", example="John Doe"),
     *     @OA\Property(property="photo_url", type="string", format="url", example="http://example.com/photo.jpg"))
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User created successfully",
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $request->validate();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'photo_url' => $request->photo_url
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->email)->plainTextToken
        ]);
    }

    /**
     * Display a specific user.
     *
     * @OA\Get(
     *     path="/api/v1/users/{id}",
     *     tags={"User management"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }

    /**
     * Update a specific user.
     *
     * @OA\Put(
     *     path="/api/v1/users/{id}",
     *     tags={"User management"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        $request->validate();

        $user->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'photo_url' => $request->photo_url
        ]);

        return $this->success(new UserResource($user));
    }

    /**
     * Delete a specific user.
     *
     * @OA\Delete(
     *     path="/api/v1/users/{id}",
     *     tags={"User management"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully"
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        $user->delete();

        return $this->success(['message' => 'User deleted successfully']);
    }

    /**
     * Get user by ID.
     *
     * @OA\Get(
     *     path="/api/v1/users/{id}/details",
     *     tags={"User management"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }

    /**
     * Get user by email.
     *
     * @OA\Get(
     *     path="/api/v1/users/email/{email}",
     *     tags={"User management"},
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }
}
