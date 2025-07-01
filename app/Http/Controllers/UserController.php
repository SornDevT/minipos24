<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth; // Ensure you have the JWTAuth package installed
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        try {

            $user = new User();
            $user->UserName = $request->UserName;
            $user->Email = $request->Email;
            $user->Password = $request->Password; // Hash the password
            $user->save();

            $success = true;
            $message ="ເພີ່ມຂໍ້ມູນສຳເລັດ!";
           
         
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }

    public function login(Request $request)
    {
 
            $credentials = [
                'email' => $request->email, // Use 'Email' as per your request
                'password' => $request->password, // Use 'Password' as per your request
            ];
            // dd($credentials);

            // Check remember me option
            if($request->remember_me) {
                // set timeout for token
                JWTAuth::factory()->setTTL(60*24*7); // 7 days
            }
            // return $credentials;
            // Attempt to authenticate the user
            $token = JWTAuth::attempt($credentials);
            $user = Auth::user();

            // dd($token);


            if ($token) {
                return response()->json([
                    'success' => true, 
                    'token' => $token,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກ',
                ], 401);
            }
      
    }

}
