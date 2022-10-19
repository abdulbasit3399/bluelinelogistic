<?php

namespace Modules\Cargo\Listeners;

use App\Events\NotificationSettingsUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Entities\CargoNotificationsSettings;

class NotificationSettingsUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationSettingsUpdated $event)
    {
        $settings = app(CargoNotificationsSettings::class);

        // echo '<pre>';print_r($settings);echo '</pre>';
        echo '<pre>';print_r($event);echo '</pre>';
        if(isset($event->data)){


            foreach(CargoNotificationsSettings::fields() as $field_key => $field){
                if(!isset($event->data[$field_key])){
                    $settings->$field_key   =   false;
                
                }else{
                    if ($field['type'] == 'bool') {
                        $settings->$field_key   =   isset($event->data[$field_key]) ? true : false;
                    } else if ($field['type'] == 'image') {
                        $image_dir = \Config::get('DIRECTORY_IMAGE');
                        /* remove image if exists
                        ******************************************/
                        $field_form_req_remove_image = isset($event->data[$field_key . '_remove']) && $event->data[$field_key . '_remove'] == 1 ? true : false;
                        if ($field_form_req_remove_image) {
                            if ($field['value'] && $field['value'] != null) {
                                $this->deleteFile($field['value'], $image_dir);
                                $settings->$field_key = '';
                            }
                        }
                        /**********************/
                        /* save image if exists
                        ******************************************/
                        if (isset($event->data[$field_key]) && $event->data[$field_key] instanceof UploadedFile) {
                            // delete the old image
                            if ($event->data[$field_key] && $event->data[$field_key] != null) {
                                $this->deleteFile($field['value'], $image_dir);
                            }
                            $image_name = $this->fileGenerateName($event->data[$field_key]);
                            $this->fileUpload($event->data[$field_key], $image_name, $image_dir);
                            $settings->$field_key = $image_name;
                        }
                    } else if ($field['type'] == 'array_boolen' || $field['type'] == 'array_enable_select') {
                        $settings->$field_key   =   json_encode($event->data[$field_key]);
                    } else {
                        $settings->$field_key   =   (isset($field['translatable']) && $field['translatable'] == true ) ? json_encode($event->data[$field_key]) : $event->data[$field_key];
                    }
                }
            }
            if (!$settings->save()){
                throw new \Exception();
            }
        }
    }
}
