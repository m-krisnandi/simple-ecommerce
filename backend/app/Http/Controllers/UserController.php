<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    // Fetch all users
    public function index()
    {
        try {
            $users = User::all();

            return response()->json(
                ResponseHelper::successResponse($users, 'User: Get All Users', 200),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                ResponseHelper::errorResponse('Failed to fetch users', 500),
                500
            );
        }
    }

    // Create a new user
    public function store(Request $request)
    {
        try {
            $validationRules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'avatar' => 'nullable|string',
                'role' => 'required|string|in:admin,user'
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
                'avatar' => $request->avatar,
                'role' => $request->role,
            ]);

            return response()->json(
                ResponseHelper::successResponse($user, 'User: Created User', 201),
                201
            );
        } catch (\Exception $e) {
            return response()->json(
                ResponseHelper::errorResponse('Failed to create user', 500),
                500
            );
        }
    }

    // Fetch a specific user
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(
                ResponseHelper::successResponse($user, 'User: Get User', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse('User not found', 404),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                ResponseHelper::errorResponse('Failed to fetch user', 500),
                500
            );
        }
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validationRules = [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'sometimes|required|string|min:8',
                'avatar' => 'nullable|string',
                'role' => 'sometimes|required|string|in:admin,user'
            ];

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json(
                    ResponseHelper::errorResponse($validator->errors()->first(), 400),
                    400
                );
            }

            $user->update($request->all());

            return response()->json(
                ResponseHelper::successResponse($user, 'User: Updated User', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse('User not found', 404),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                ResponseHelper::errorResponse('Failed to update user', 500),
                500
            );
        }
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(
                ResponseHelper::successResponse(new \stdClass(), 'User: Deleted User', 200),
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ResponseHelper::errorResponse('User not found', 404),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                ResponseHelper::errorResponse('Failed to delete user', 500),
                500
            );
        }
    }
}
