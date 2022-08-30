<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        // $attr = $request->validate([
        //     'phone' => 'required|max:255|unique:users',
        //     'password' => 'required|string|max:4'
        // ]);

        $response = array('response' => '', 'success' => false);
        $validator = Validator::make($request->all(), ([
            'phone' => 'required|max:255|unique:users',
            'pin' => 'required|string|max:4'
        ]));

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()]);
            // $response['response'] = $validator->messages();
        }
        $user = User::create([
            'phone' => $request->phone,
            'pin' => Hash::make($request->pin),
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        // $attr = $request->validate([
        //     'phone' => 'required|max:255',
        //     'pin' => 'required|max:6'
        // ]);

        $response = array('response' => '', 'success' => false);
        $validator = Validator::make($request->all(), ([
            'phone' => 'required|max:255',
            'pin' => 'required|string|max:4'
        ]));

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()]);
            // $response['response'] = $validator->messages();
        }
        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->pin], false)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
