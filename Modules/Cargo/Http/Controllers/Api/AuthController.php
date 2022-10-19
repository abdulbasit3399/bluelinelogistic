<?php

namespace Modules\Cargo\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use app\Http\Helpers\ApiHelper;
use DB;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\ShipmentSetting;
use Modules\Cargo\Entities\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        try{	

            $data = Validator::make($request->all(), [ 
                'name'               => 'required|string|min:3|max:50',
                'email'              => 'required|max:50|email|unique:users,email',
                'password'           => 'required|string|min:6',
                'responsible_mobile' => 'required|digits_between:8,20',
                'responsible_name'   => 'required|string|min:3|max:50',
                'national_id'        => 'required',
                'branch_id'          => 'required',
                'type'               => 'required',
            ]);
            
            if ($data->fails()) {
                return response()->json($data->errors(), 400);
            }

            $Userdata['name']     = $request->name;
            $Userdata['email']    = $request->email;
            $Userdata['password'] = $request->password;
            
            if($request->type == 'client'){
                $Userdata['role'] = 4;
                $model = new Client();

                $model->pickup_cost  = ShipmentSetting::getVal('def_pickup_cost');
                $model->supply_cost  = ShipmentSetting::getVal('def_supply_cost');
            }elseif($request->type == 'driver') {
                $Userdata['role'] = 5;
                $model = new Driver();
            }else{
                return response()->json(['message' => 'Invalid user type']);
            }

            $userRegistrationHelper = new UserRegistrationHelper();
            $response = $userRegistrationHelper->NewUser($Userdata);
            if(!$response['success']){
                throw new \Exception($response['error_msg']);
            }
            $user = $response['user'];

            $model->user_id     = $response['user']['id'];
            $model->created_by  = $response['user'] ? $response['user']['id'] : null;
            $model->name        = $request->name;
			$model->email       = $request->email;
            $model->branch_id   = $request->branch_id;
            $model->code        = 0;
			$model->responsible_mobile = $request->responsible_mobile;
            $model->responsible_name   = $request->responsible_name;
            $model->national_id        = $request->national_id;

            if (!$model->save()){
                throw new \Exception();
            }
            $model->code = $model->id;
            if (!$model->save()){
                throw new \Exception();
            }
            
            return response()->json([
                'remember_token' => $user->remember_token,
                'token_type'     => 'Bearer',
                'user' => [
                    'id'              => $model->id,
                    'name'            => $model->name,
                    'email'           => $model->email,
                    'phone'           => $model->responsible_mobile,
                    'balance'         => 0,
                ]
            ]);
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized', 'user' => null], 401);
        $user = $request->user();
        
        return $this->loginSuccess($user);
    }

    protected function loginSuccess($user)
    {
      	if($user->role == 4){
            $model = Client::where('user_id', $user->id )->first();
            $transactions = Transaction::where('client_id', $model->id)->orderBy('created_at','desc')->sum('value');
        }elseif($user->role == 5){
          	$model = Driver::where('user_id', $user->id )->first();
            $transactions = Transaction::where('captain_id', $model->id)->orderBy('created_at','desc')->sum('value');
        }else{
            return response()->json(['message' => 'Invalid user type']);
        }

        $transactions = abs($transactions); // Converting the transactions from negative to positive
        return response()->json([
            'remember_token' => $user->remember_token,
            'token_type' => 'Bearer',
            'user' => [
                'id'      => $model->id,
                'type'    => $user->role,
                'name'    => $model->name,
                'email'   => $model->email,
                'phone'   => $model->responsible_mobile,
                'balance' => $transactions,
            ]
        ]);
    }

    public function getWallet(Request $request)
    {
      	
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            if($request->type == 'client'){
                $model = Client::where('user_id',$user->id)->first();
                $transactions = Transaction::where('client_id', $model->id)->orderBy('created_at','desc')->sum('value');
            }elseif ($request->type == 'driver') {
                $model = Driver::where('user_id',$user->id)->first();
                $transactions = Transaction::where('captain_id', $model->id)->orderBy('created_at','desc')->sum('value');
            }else{
              	return response()->json(['message' => 'Invalid user type'] );
            }
            $transactions = abs($transactions); // Converting the transactions from negative to positive
            return response()->json($transactions);
        }else{
            return response()->json('Not Authorized');
        }
    }


}
