<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;




class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $errors  = json_decode($validator->errors());
            $email   =isset($errors->email[0])? $errors->email[0] : '';
            $password=isset($errors->password[0])? $errors->password[0] : '';

            if($email){
              $msg = $email;
            }else if($password){
              $msg = $password;
            }
            
            return response()->json(['message' =>$validator->errors(),'data'=>[],'statusCode'=>422,'success'=>'error'],422);
        }

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
