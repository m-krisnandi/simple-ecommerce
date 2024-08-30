<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validationRules = [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|confirmed',
            ];

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json(
                    ResponseHelper::errorResponse($validator->errors()->first(), 400),
                    400
                );
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken($request->name)->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json(
                ResponseHelper::successResponse($response, 'User: Register User', 201),
                201
            );
        } catch (QueryException $e) {
            return response()->json(
                ResponseHelper::errorResponse('An error occurred while registering the user.', 500),
                500
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $stringRule = 'required|string';

            $validationRules = [
                'email' => $stringRule,
                'password' => $stringRule,
            ];

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json(
                    ResponseHelper::errorResponse($validator->errors()->first(), 400),
                    400
                );
            }

            // Check email
            $user = User::where('email', $request->email)->first();

            // Check password
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(
                    ResponseHelper::errorResponse('Bad creds', 401),
                    401
                );
            }

            $token = $user->createToken('secret')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json(
                ResponseHelper::successResponse($response, 'User: Login User', 201),
                201
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse(ResponseHelper::INTERNAL_SERVER_ERROR_MESSAGE, 500),
                500
            );
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(
            ResponseHelper::successResponse(new \stdClass(), 'User: Logged out', 200),
            200
        );
    }

    public function profile() {
        $userData = auth()->user();
        return response()->json(ResponseHelper::successResponse($userData, 'User: Profile Information', 200),
        200);
    }
}
