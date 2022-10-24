<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class AuthenticatedUserSessionController extends Controller
{
    /**
     * Redirect to login if guest, to home if auth.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect(env('PREFIX_ADMIN', 'admin') . RouteServiceProvider::HOME);
        } else {
            return redirect()->route('userlogin');
        }
    }



    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // dd('create');
        $current_version = \app\Models\Settings::where('name','current_version')->first();
        if(!$current_version){
            // Run sql modifications
            $sql_current_version_path = base_path('database/set_current_version.sql');
            if (file_exists($sql_current_version_path)) {
                DB::unprepared(file_get_contents($sql_current_version_path));
            }
            DB::commit();
        }

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.auth.userlogin');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($request->type == 'Good')
        {
            $user = User::where([['email',$request->email],['type',$request->type]])->first();
            if($user)
            {
                if(Hash::check($request->password, $user->password))
                {
                    Auth::login($user);
                    return redirect()->route('shipments.view.tracking');
                }
                else
                    return redirect()->back()->with('error', 'Please enter correct password');
            }
            else
            {
                return redirect()->back()->with('error', 'Please enter correct email');
            }

        }
        elseif($request->type == 'Vault')
        {
            $user = User::where([['email',$request->email],['type',$request->type]])->first();
            if($user)
            {
                if(Hash::check($request->password, $user->password))
                {
                    Auth::login($user);
                    return redirect()->route('shipments.vault.view.tracking');
                }
                else{
                    return redirect()->back()->with('error', 'Please enter correct password');
                }
            }
            else
            {
                return redirect()->back()->with('error', 'Please enter correct email');
            }

        }


    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // dd('a');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('userlogin');
    }
}
