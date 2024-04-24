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

class UserController extends Controller
{

    use HttpResponses;

    // Get all users
    public function index()
    {
        $users = new UserCollection(User::all());
        return $this->success($users);
    }

    // Create a new user
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

    public function show($id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }

    // Update user
    // Update user
    public function update(UpdateUserRequest $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        // Validate the request data
        $request->validate();

        // Update the user
        try {
            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'full_name' => $request->full_name,
                'photo_url' => $request->photo_url
                // Add more fields as needed
            ]);

            return $this->success(new UserResource($user)); // Assuming you have a success method for consistent responses
        } catch (\Exception $e) {
            return $this->error(null, 'User not found', 404);
        }
    }


    // Delete user
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        $user->delete();

        return $this->success(['message' => 'User deleted successfully']);
    }

    // Get user by ID
    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }

    // Get user by email
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success(new UserResource($user));
    }
}
