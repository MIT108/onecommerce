<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    //
    public function create(Request $request){
        $fields = $request->validate([
            'email' => 'required|email',
        ]);

        $response = [];
        $code = 0;

        if($this->checkEmail($fields['email'])){
            try {
                Subscribe::Create($fields);
                $response = [
                    'message' => "successful"
                ];
                $code = 200;
            } catch (\Throwable $th) {
                //throw $th;
                $response = [
                    'message' => $th->getMessage(),
                ];
                $code = 500;
            }
        }else{
            $response = [
                "message" => "Email already exists"
            ];
            $code = 422;
        }

        return response($response, $code);
    }

    public function checkEmail($email){
        if (Subscribe::where('email', '=', $email)->count() > 0){
            return false;
        }else{
            return true;
        }
    }
}
