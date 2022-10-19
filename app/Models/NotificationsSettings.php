<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class NotificationsSettings extends Settings
{

    public $email;
    public $sms;
    public $fcm;

    public static function fields(): array
    {
        $settings = app(NotificationsSettings::class);

        $fields = [
            'email'             =>  array(
                'label'         =>  'settings.email_notifications',
                'type'          =>  'array_boolen',
                'value'         =>  $settings->email,
                'array'         =>  array(
                    'MAIL_DRIVER'      =>   [
                        'label'         =>  'settings.select_provider',
                        'translatable'  =>  false,
                        'type'          =>  'select',
                        'options'       =>  array(
                                                'sendmail'   =>  "Sendmail",
                                                'smtp'   =>  "SMTP",
                                                'mailgun'   =>  "Mailgun",
                                            ),
                        'value'         =>  json_decode($settings->email, true)['MAIL_DRIVER'] ?? '',
                        'conditionier'  =>  true,
                        'required'      =>  true
                    ],
                    'MAIL_FROM_NAME'     =>   [
                        'label'         =>  'settings.mail_from_name',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAIL_FROM_NAME'] ?? '',
                        'required'      =>  true
                    ],
                    'MAIL_FROM_ADDRESS'     =>   [
                        'label'         =>  'settings.mail_from_address',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAIL_FROM_ADDRESS'] ?? '',
                        'required'      =>  true
                    ],
                    'MAIL_HOST'     =>   [
                        'label'         =>  'settings.mail_host',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAIL_HOST'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'smtp',
                        'required'      =>  true
                    ],
                    'MAIL_PORT'     =>   [
                        'label'         =>  'settings.mail_port',
                        'type'          =>  'number',
                        'value'         =>  json_decode($settings->email, true)['MAIL_PORT'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'smtp',
                        'required'      =>  true
                    ],
                    'MAIL_USERNAME'     =>   [
                        'label'         =>  'settings.mail_username',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAIL_USERNAME'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'smtp',
                        'required'      =>  true
                    ],
                    'MAIL_PASSWORD'     =>   [
                        'label'         =>  'settings.mail_password',
                        'type'          =>  'password',
                        'value'         =>  json_decode($settings->email, true)['MAIL_PASSWORD'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'smtp',
                        'required'      =>  true
                    ],
                    'MAIL_ENCRYPTION'     =>   [
                        'label'         =>  'settings.mail_encryption',
                        'type'          =>  'select',
                        'options'       =>  array(
                                                'ssl'   =>  "SSL",
                                                'tls'   =>  "TLS",
                                            ),
                        'value'         =>  json_decode($settings->email, true)['MAIL_ENCRYPTION'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'smtp',
                        'required'      =>  true
                    ],
                    'MAILGUN_DOMAIN'     =>   [
                        'label'         =>  'settings.mailgun_domain',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAILGUN_DOMAIN'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'mailgun',
                        'required'      =>  true
                    ],
                    'MAILGUN_SECRET'     =>   [
                        'label'         =>  'settings.mailgun_secret',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->email, true)['MAILGUN_SECRET'] ?? '',
                        'if'            =>  'MAIL_DRIVER',
                        'if_value'      =>  'mailgun',
                        'required'      =>  true
                    ],
                )
            ),
            'sms'               =>  array(
                'label'         =>  'settings.sms_notifications',
                'type'          =>  'array_boolen',
                'value'         =>  $settings->sms,
                'array'         =>  array(
                    'sms_provider'      =>   [
                        'label'         =>  'settings.select_provider',
                        'translatable'  =>  false,
                        'type'          =>  'select',
                        'options'       =>  array(
                                                'twilio'   =>  "Twilio",
                                                'nexmo'   =>  "Nexmo",
                                                'ssl'   =>  "SSL Wireless",
                                                'fast2sms'   =>  "FAST2SMS",
                                                'mimo'   =>  "MIMO",
                                            ),
                        'value'         =>  json_decode($settings->sms, true)['sms_provider'] ?? '',
                        'conditionier'  =>  true,
                        'required'      =>  true
                    ],
                    'twilio_sender_number'     =>   [
                        'label'         =>  'settings.sender_number',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['twilio_sender_number'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'twilio',
                        'required'      =>  true
                    ],
                    'twilio_sid'     =>   [
                        'label'         =>  'settings.sid',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['twilio_sid'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'twilio',
                        'required'      =>  true
                    ],
                    'twilio_auth_token'     =>   [
                        'label'         =>  'settings.auth_token',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['twilio_auth_token'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'twilio',
                        'required'      =>  true
                    ],
                    'nexmo_sender_number'     =>   [
                        'label'         =>  'settings.sender_number',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['nexmo_sender_number'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'nexmo',
                        'required'      =>  true
                    ],
                    'nexmo_key'     =>   [
                        'label'         =>  'settings.nexmo_key',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['nexmo_key'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'nexmo',
                        'required'      =>  true
                    ],
                    'nexmo_secret'     =>   [
                        'label'         =>  'settings.nexmo_secret',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['nexmo_secret'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'nexmo',
                        'required'      =>  true
                    ],
                    'ssl_api_token'     =>   [
                        'label'         =>  'settings.ssl_api_token',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['ssl_api_token'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'ssl',
                        'required'      =>  true
                    ],
                    'ssl_sid'     =>   [
                        'label'         =>  'settings.sid',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['ssl_sid'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'ssl',
                        'required'      =>  true
                    ],
                    'ssl_url'     =>   [
                        'label'         =>  'settings.ssl_url',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['ssl_url'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'ssl',
                        'required'      =>  true
                    ],
                    'fast2sms_auth_key'     =>   [
                        'label'         =>  'settings.auth_key',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['fast2sms_auth_key'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'fast2sms',
                        'required'      =>  true
                    ],
                    'fast2sms_route'     =>   [
                        'label'         =>  'settings.route',
                        'type'          =>  'select',
                        'options'       =>  array(
                                                'p'   =>  "Promotional Use",
                                                't'   =>  "Transactional Use",
                                            ),
                        'value'         =>  json_decode($settings->sms, true)['fast2sms_route'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'fast2sms',
                        'required'      =>  true
                    ],
                    'fast2sms_language'     =>   [
                        'label'         =>  'settings.langauge',
                        'type'          =>  'select',
                        'options'       =>  array(
                                                'english'   =>  "English",
                                                'unicode'   =>  "Unicode",
                                            ),
                        'value'         =>  json_decode($settings->sms, true)['fast2sms_language'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'fast2sms',
                        'required'      =>  true
                    ],
                    'fast2sms_sender_id'     =>   [
                        'label'         =>  'settings.sender_id',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['fast2sms_sender_id'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'fast2sms',
                        'required'      =>  true
                    ],
                    'mimo_username'     =>   [
                        'label'         =>  'settings.username',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['mimo_username'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'mimo',
                        'required'      =>  true
                    ],
                    'mimo_password'     =>   [
                        'label'         =>  'settings.password',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['mimo_password'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'mimo',
                        'required'      =>  true
                    ],
                    'mimo_sender_id'     =>   [
                        'label'         =>  'settings.sender_id',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->sms, true)['mimo_sender_id'] ?? '',
                        'if'            =>  'sms_provider',
                        'if_value'      =>  'mimo',
                        'required'      =>  true
                    ],
                )
            ),
            'fcm'               =>  array(
                'label'         =>  'settings.push_notifications',
                'type'          =>  'array_boolen',
                'value'         =>  $settings->fcm,
                'array'         =>  array(
                    'fcm_key'     =>   [
                        'label'         =>  'settings.fcm_key',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->fcm, true)['fcm_key'] ?? '',
                        'required'      =>  true
                    ],
                )
            ),
        ];
        $all_modules = array_map('basename', \Illuminate\Support\Facades\File::directories(base_path('Modules')) );

        $notifications = array();
        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            if(check_module($module_name)){
                $notifications = config("$module_name.notifications");
                if($notifications)
                    $fields = array_merge($fields,$notifications);
            }
        }
        return $fields;
    }

    public static function scripts(): string
    {
        
        $scripts = '
            <script>

                $(".conditionier").each(function(){

                    var name=$(this).attr("id").replace("fields[","").replace("]","");
                    var value=$(this).val();
                    var appear = "if_"+name+"_"+value;
                    
                    $(".condition_fields.if_"+name).hide();

                    $(".condition_fields.if_"+name+" input").prop( "disabled", true );
                    $(".condition_fields.if_"+name+" select").prop( "disabled", true );

                    $("."+appear).show();
                    $("."+appear).find("input").prop( "disabled", false );
                    $("."+appear).find("select").prop( "disabled", false );
                });

                $(".conditionier").on("change", function(){

                    var name=$(this).attr("id").replace("fields[","").replace("]","");
                    var value=$(this).val();
                    var appear = "if_"+name+"_"+value;
                    
                    $(".condition_fields.if_"+name).hide();

                    $(".condition_fields.if_"+name+" input").prop( "disabled", true );
                    $(".condition_fields.if_"+name+" select").prop( "disabled", true );

                    $("."+appear).show();
                    $("."+appear).find("input").prop( "disabled", false );
                    $("."+appear).find("select").prop( "disabled", false );
                });

                $(".array_boolen_ckeck").each(function(){
                    var id=$(this).attr("id");
                    if($(this).is(":checked") == true){
                        $("."+id).prop( "disabled", false );
                        $("."+id+"_label").removeClass("label-disabled");
                    }else{
                        $("."+id).prop( "disabled", true );
                        $("."+id+"_label").addClass("label-disabled");
                    }
                });

                $(".array_boolen_ckeck").on("click", function(){
                    var id=$(this).attr("id");
                    if($(this).is(":checked") == true){
                        $("."+id).prop( "disabled", false );
                        $("."+id+"_label").removeClass("label-disabled");
                        conditionier_check();
                    }else{
                        $("."+id).prop( "disabled", true );
                        $("."+id+"_label").addClass("label-disabled");
                    }
                });
                conditionier_check();
                function conditionier_check(){
                    $(".conditionier").each(function(){
                        var id=$(this).attr("id");
                        if(id){
                            var name=id.replace("fields[","").replace("]","");
                            var value=$(this).val();
                            var appear = "if_"+name+"_"+value;

                            $(".if_"+name+" input").prop( "disabled", true );
                            $(".if_"+name+" select").prop( "disabled", true );

                            if($(this).is(":disabled") != true){
                                $("."+appear+" input").prop( "disabled", false );
                                $("."+appear+" select").prop( "disabled", false );
                                $("."+appear).show();
                            }
                        }

                    });
                }
            </script>
        ';

        return $scripts;
    }
    
    public static function group(): string
    {
        return 'notifications';
    }
    
    public static function encrypted(): array
    {
        return [
            
        ];
    }
}
