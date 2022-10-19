<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\GoogleSettings;
use App\Http\Requests\NotificationsRequest;
use App\Events\NotificationSettingsUpdated;

class GoogleSettingsController extends Controller
{

    public function __construct()
    {
        // check on permissions
        $this->middleware('can:manage-google-setting');
    }
    
    public function index()
    {
        breadcrumb([
            [
                'name' => __('view.dashboard'),
            ],
            [
                'name' => __('view.google_settings'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.google-settings', ['fields' => GoogleSettings::fields(),'fields_script' => GoogleSettings::scripts()]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(GoogleSettings $settings, NotificationsRequest $request)
    {
        foreach(GoogleSettings::fields() as $field_key => $field){

            if(!isset($request->fields[$field_key])){
                $settings->$field_key   =   false;
            
            }else{
                if ($field['type'] == 'bool') {
                    $settings->$field_key   =   isset($request->fields[$field_key]) ? true : false;
                } else if ($field['type'] == 'image') {
                    $image_dir = \Config::get('DIRECTORY_IMAGE');
                    /* remove image if exists
                    ******************************************/
                    $field_form_req_remove_image = isset($request->fields[$field_key . '_remove']) && $request->fields[$field_key . '_remove'] == 1 ? true : false;
                    if ($field_form_req_remove_image) {
                        if ($field['value'] && $field['value'] != null) {
                            $this->deleteFile($field['value'], $image_dir);
                            $settings->$field_key = '';
                        }
                    }
                    /**********************/
                    /* save image if exists
                    ******************************************/
                    if (isset($request->fields[$field_key]) && $request->fields[$field_key] instanceof UploadedFile) {
                        // delete the old image
                        if ($request->fields[$field_key] && $request->fields[$field_key] != null) {
                            $this->deleteFile($field['value'], $image_dir);
                        }
                        $image_name = $this->fileGenerateName($request->fields[$field_key]);
                        $this->fileUpload($request->fields[$field_key], $image_name, $image_dir);
                        $settings->$field_key = $image_name;
                    }
                } else if ($field['type'] == 'array_boolen' || $field['type'] == 'array_enable_select') {
                    $settings->$field_key   =   json_encode($request->fields[$field_key]);
                } else {
                    $settings->$field_key   =   (isset($field['translatable']) && $field['translatable'] == true ) ? json_encode($request->fields[$field_key]) : $request->fields[$field_key];
                }
            }
        }
        $settings->save();

        event(new NotificationSettingsUpdated($request->fields));
        
        return redirect()->back();
    }

}
