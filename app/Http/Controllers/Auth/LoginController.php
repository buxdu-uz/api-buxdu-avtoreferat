<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|exists:users,login',
            'password' => 'required',
        ]);

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $user = User::where('login', $request->login)->first();

            $token = $user->createToken('token-name', [$user->login])->plainTextToken;
//            return $this->successResponse([
//                'token' => $token
//            ], new UserResource($user));

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => new UserResource($user),
                'token' => $token, // if using Sanctum
            ]);

        }
        return $this->errorResponse('Login or password error', 404);
    }

    public function logout()
    {
        // Get the currently authenticated user for the 'employee' guard
        $user = Auth::user();

        if ($user && $user->currentAccessToken()) {
            // Revoke the current access token
            $user->currentAccessToken()->delete();
        }

        return $this->successResponse('Logged out successfully');
    }

//    public function updateLoginPassword(UpdateUserRequest $request)
//    {
//        $user = Auth::user();
//        if (!Hash::check($request->current_password, $user->password)) {
//            return $this->errorResponse('Current password is incorrect');
//        }
//
//        // Update password
//        $user->password = Hash::make($request->new_password);
//        $user->update();
//
//        return $this->successResponse('Password updated successfully', new UserResource($user));
//    }
}
