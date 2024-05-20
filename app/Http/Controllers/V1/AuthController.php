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

class AuthController extends Controller
{
    use HttpResponses;

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

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

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

    public function logout()
    {
        return "this is my logout";
    }


    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback()
    {

        $user = Socialite::driver('google')->stateless()->user();


        $userCreated = User::firstOrCreate([
            'email' => $user->email
        ], [
            'full_name' => $user->name,
            'photo_url' => $user->avatar,
            'email_verified_at' => now()
        ]);

        $userCreated->providers()->updateOrCreate([
            'provider' => 'google',
            'provider_id' => $user->getId()
        ],[
            'avatar' => $user->avatar
        ]);

        $token = $userCreated->createToken('API token of ' . $userCreated->email)->plainTextToken;

        return redirect()->to('http://localhost:3000/auth/callback?token=' . $token);

    }

    /**
     * @param $provider
     * @return JsonResponse
     */

}
