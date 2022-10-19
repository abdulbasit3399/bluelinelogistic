<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Acl\Repositories\AclRepository;
use Storage;
use ZipArchive;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File; 
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{

    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1');
    }
    
    public function getSystemUpdate()
    {
        breadcrumb([
            [
                'name' => __('view.system_update')
            ]
            // 'path' => RouteServiceProvider::HOME,
        ]); // See App/Helpers/functions/helpers.php -> breadcrumb function
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.system-update');
    }

    public function postSystemUpdate(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        $request->validate([
            'zip_file' => 'required|mimes:zip'
        ]);
        
        set_time_limit(0);
        
        $originFileName = basename($request->file('zip_file')->getClientOriginalName(), '.'.$request->file('zip_file')->getClientOriginalExtension());
        $originFileName = $originFileName . 'z';
        $updateVersion  = floatval(get_string_between($originFileName,'_','z'));
        $currentVersion = floatval(preg_replace('/[\\\@\;\" "]+/', '', get_general_setting('current_version'))) + 0.1;
        $currentVersion = number_format($currentVersion,1);

        if($currentVersion == $updateVersion){
            $dir = 'updates';
            if (!is_dir($dir))
                mkdir($dir, 0777, true);

            $path = Storage::disk('local')->put('updates', $request->zip_file);

            $zipped_file_name = $request->zip_file->getClientOriginalName();

            //Unzip uploaded update file and remove zip file.
            $zip = new ZipArchive;
            $res = $zip->open(base_path('storage/app/' . $path));

            $random_dir = Str::random(10);

            if ($res === true) {
                $res = $zip->extractTo(base_path('temp/' . $random_dir . '/updates'));
                $zip->close();
            } else {
                dd('could not open');
            }
            $str = file_get_contents(base_path('temp/' . $random_dir . '/updates/config.json'));

            $json = json_decode($str, true);

            $files = array();
            if (!empty($json['files'])) {
                foreach ($json['files'] as $file) {
                    $update_directory = base_path('temp/' . $random_dir . '/updates/' . $file['name']);
                    $base_directory   = base_path($file['base_directory']);

                    File::copyDirectory($update_directory, $base_directory);
                    // $file = new Filesystem;
                    // $file->cleanDirectory($base_directory);
                }

                try {
                    // Run sql modifications
                    $sql_current_version_path = base_path('temp/' . $random_dir . '/updates/update.sql');
                    if (file_exists($sql_current_version_path)) {
                        DB::unprepared(file_get_contents($sql_current_version_path));
                    }
                    DB::commit();
                    // all good
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                }
            }
            // Create the symbolic link
            Artisan::call('storage:link');

            return redirect()->back()->with(['message_alert' => __('view.updated_successfully_to_version') .' '.$currentVersion + 0.1]);
        }else{
            return redirect()->back()->with(['error_message_alert' => __('view.please_update_version') .' '.$currentVersion + 0.1]);
        }
    }

}
