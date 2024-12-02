<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);

        if ($validator->fails()) {
            return response("Gagal");
        }

        $role = 3;
        $pass = password_hash($request->password, PASSWORD_BCRYPT);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role_id'=>$role,
            'password'=>$pass,
        ]);

        return $user->createToken('auth token')->plainTextToken;
    }
    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email'=>["The provided credentials are incorrect"],
            ]);
        }

        return $user->createToken('auth token')->plainTextToken;
    }
    public function logout(Request $request) {
        return $request->user()->currentAccessToken()->delete();
    }
    public function user(Request $request) {
        return $request->user();
    }
}
