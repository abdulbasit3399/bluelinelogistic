<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiHelper{

 
    public function checkUser(Request $request)
    {
        if($request->is('api/*')){
            $token = $request->header('token');
            if(isset($token))
            {
                $user = User::where('remember_token',$token)->first();

                if(!$user)
                {
                    return false;
                }
                return $user;
            }else{
                return false;
            }      
        }
    }


}