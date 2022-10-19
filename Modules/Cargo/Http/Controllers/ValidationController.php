<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use Modules\Cargo\Entities\Client;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;


class ValidationController extends Controller
{
    public function ajax_check_email(Request $request)
    {
        
        $isUniqueEmail = true;
        $type = $_GET['type'];
        $email = $_GET[$type];
        
        $user = User::where('email', $email)->first();
        if($user != null){
            $isUniqueEmail =  false;

            if($request->calc){
                if($type == 'Client'){
                    $client = Client::where('email', $email)->first();
                    if($client == null){
                        $isUniqueEmail =  true;
                    }   
                }
            }
        }
        
        return json_encode(array(
            'valid' => $isUniqueEmail,
        ));
    }
}