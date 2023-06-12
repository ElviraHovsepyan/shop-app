<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

        if ($validateUser->fails()) {
            return new ErrorResource((object)['code' => 400, 'message' => $validateUser->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => Role::where('name', 'Customer')->first()->id,
            'password' => Hash::make($request->password)
        ]);

        $response = (object)[
            'status' => 200,
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ];
        return new SuccessResource($response);
    }


    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

        if ($validateUser->fails()) {
            return new ErrorResource((object)['code' => 401, 'message' => $validateUser->errors()]);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return new ErrorResource((object)['code' => 401, 'message' => 'Email & Password does not match with our record.']);
        }

        $user = User::where('email', $request->email)->first();

        $response = (object)[
            'status' => 200,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ];
        return new SuccessResource($response);
    }

    public function test()
    {
        return '12345';
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = (object)[
            'message' => 'Successfully logged out!'
        ];
        return new SuccessResource($response);
    }
}
