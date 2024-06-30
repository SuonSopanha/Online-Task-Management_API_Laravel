<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use App\Http\Requests\V1\LoginUserRequest;
use App\Http\Requests\V1\StoreUserRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="APIs for user authentication"
 * )
 */
class AuthController extends Controller
{
    use HttpResponses;

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="token", type="string", example="your-api-token-here")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials"
     *     )
     * )
     */
    public function login(LoginUserRequest $request)
    {
        $validatedData = $request->validated();

        if (!Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return $this->error('', 'Invalid credentials', 401);
        }

        $user = User::where('email', $validatedData['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->email)->plainTextToken
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     tags={"Authentication"},
     *     summary="User registration",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password", "full_name"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="photo_url", type="string", format="url", example="http://example.com/photo.jpg"),
     *             @OA\Property(property="token", type="string", example="your-api-token-here")
     *         )
     *     )
     * )
     */
    public function register(StoreUserRequest $request)
    {
        $request->validated();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'photo_url' => $request->photo_url,
            'role' => 'user'
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->email)->plainTextToken
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     tags={"Authentication"},
     *     summary="User logout",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success([], 'Logged out successfully');
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/redirect/{provider}",
     *     tags={"Authentication"},
     *     summary="Redirect to provider for authentication",
     *     @OA\Parameter(
     *         name="provider",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", example="google")
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redirect to provider's authentication page"
     *     )
     * )
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/callback/{provider}",
     *     tags={"Authentication"},
     *     summary="Handle provider callback",
     *     @OA\Parameter(
     *         name="provider",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", example="google")
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redirect with token"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $userCreated = User::firstOrCreate([
            'email' => $user->email
        ], [
            'full_name' => $user->name,
            'photo_url' => $user->avatar,
            'email_verified_at' => now()
        ]);

        $userCreated->providers()->updateOrCreate([
            'provider' => $provider,
            'provider_id' => $user->getId()
        ],[
            'avatar' => $user->avatar
        ]);

        $token = $userCreated->createToken('API token of ' . $userCreated->email)->plainTextToken;

        return redirect()->to('https://online-task-management-client-side-react.onrender.com/auth/callback?token=' . $token);
    }
}
