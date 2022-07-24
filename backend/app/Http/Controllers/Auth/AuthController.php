<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string'],
            ]);
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);
            $access_token = $user->createUserToken();
            return response()->json(compact('user', 'access_token'));
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if ($request->has('access_token')) {
            return response(['access_token' => $request->access_token], 200);
        }
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $access_token = $user->createUserToken();
            return response()->json(compact('user', 'access_token'));
        }

        return response()->json([
            'email' => 'The provided credentials do not match our records.',
        ], 401);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }

    /**
     * @param Request $request
     * @return User
     */
    public function getUser(Request $request): User
    {
        return $request->user();
    }
}
