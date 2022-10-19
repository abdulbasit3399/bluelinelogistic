<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        breadcrumb([
            [
                'name' => __('view.dashboard')
            ]
            // 'path' => RouteServiceProvider::HOME,
        ]); // See App/Helpers/functions/helpers.php -> breadcrumb function
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.dashboard');
    }

    public function step0()
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.oldDatabase.step0');
    }

    public function step1() {

        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $permission['curl_enabled']           = function_exists('curl_version');
        $permission['db_file_write_perm']     = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.oldDatabase.step1', compact('permission'));
    }

    public function step2() {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.oldDatabase.step2');
    }

    public function step3($error = "") {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $permission['curl_enabled']           = function_exists('curl_version');
        $permission['db_file_write_perm']     = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        if($error == ""){
            return view($adminTheme.'.pages.oldDatabase.step3', compact('permission'));
        }else {
            return view($adminTheme.'.pages.oldDatabase.step3', compact('error','permission'));
        }
    }

    public function step4() {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.oldDatabase.step4');
    }

    public function step5() {
        return view('installation.step5');
    }

    public function purchase_code(Request $request) {
        return redirect('step3');
    }

    public function database_installation(Request $request) {

        if(self::check_database_connection($request->DB_HOST_SECOND, $request->DB_DATABASE_SECOND, $request->DB_USERNAME_SECOND, $request->DB_PASSWORD_SECOND)) {
            $path = base_path('.env');
            if (file_exists($path)) {
                foreach ($request->types as $type) {
                    $this->writeEnvironmentFile($type, $request[$type]);
                }
                return redirect()->route('step4');
            }else {
                return redirect()->route('step3');
            }
        }else {
            return redirect()->route('step3', "database_error");
        }
    }

    public function import_sql(Request $request) {

        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        Artisan::call('database:import');

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "") {

        if(@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        }else {
            return false;
        }
    }

    public function writeEnvironmentFile(string $key, $value = '') {

        $path = app()->environmentFilePath();
        $env = file_get_contents($path);

        $old_value = env($key);

        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }

        file_put_contents($path, $env);
    }

}
