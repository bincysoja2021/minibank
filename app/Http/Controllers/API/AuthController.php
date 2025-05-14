<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;





class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) 
        {
            return response()->json(['message' => 'Invalid credentials','statusCode' => "401"], 401);
        }

        $user = Auth::user();
        if ($user->user_type !== 'Customer') 
        {
            return response()->json(['message' => 'Access denied','statusCode' => "403"], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message'=>"Result fetched  successfully", 'statusCode' => $this-> successStatus,'access_token'=>$token,'success' => 'success',            'token_type' => 'Bearer'], $this-> successStatus);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully','statusCode' => $this-> successStatus]);
    }
}
