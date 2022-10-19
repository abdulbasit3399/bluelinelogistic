<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\NotificationsSettings;
use App\Http\Requests\NotificationsRequest;
use App\Events\NotificationSettingsUpdated;

class NotificationsSettingsController extends Controller
{

    public function __construct()
    {
        // check on permissions
        $this->middleware('can:manage-notifications-setting')->only('index', 'update');
    }
    
    public function index()
    {
        breadcrumb([
            [
                'name' => __('view.dashboard'),
            ],
            [
                'name' => __('view.notifications_settings'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.notifications-settings', ['fields' => NotificationsSettings::fields(),'fields_script' => NotificationsSettings::scripts()]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(NotificationsSettings $settings, NotificationsRequest $request)
    {
        // if(isset($request->fields['email'])){
        //     foreach($request->fields['email'] as $key => $item){
        //         setEnvValue($key, $item ?? '');
        //         if( $key == 'MAIL_DRIVER'){
        //             if($item != 'mailgun'){
        //                 setEnvValue('MAIL_DRIVER', 'sendmail');
        //             }
        //         }
        //     }
            
        // }

        foreach(NotificationsSettings::fields() as $field_key => $field){
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

    // public function notifications()
    // {
    //     $notifications = Auth::user()->allNotifications;
    //     return view('backend.notifications.index', compact('notifications') );
    // }

    public function notification($id)
    {

        $notification = \Auth::user()->notifications()->where('id',$id)->first();
        if($notification->read_at == null){
            $notification->markAsRead();
        }

        return redirect($notification->data['message']['url']);
    }

}
