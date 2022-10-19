<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AuthenticatedSessionController extends Controller
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
            return redirect()->route('login');
        }
    }



    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        return view($adminTheme.'.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(env('PREFIX_ADMIN', 'admin') . RouteServiceProvider::HOME);
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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
