<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class GoogleSettings extends Settings
{

    public $google_map;

    public static function fields(): array
    {
        $settings = app(GoogleSettings::class);

        $fields = [
            'google_map'               =>  array(
                'label'         =>  'settings.google_map',
                'type'          =>  'array_boolen',
                'value'         =>  ($settings->google_map ? $settings->google_map : ''),
                'array'         =>  array(
                    'google_map_key'     =>   [
                        'label'         =>  'settings.google_map_key',
                        'type'          =>  'string',
                        'value'         =>  json_decode($settings->google_map, true)['google_map_key'] ?? '',
                        'required'      =>  true
                    ],
                )
            ),
        ];
        $all_modules = array_map('basename', \Illuminate\Support\Facades\File::directories(base_path('Modules')) );

        $google_settings = array();
        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            if(check_module($module_name)){
                $google_settings = config("$module_name.googleSettings");
                if($google_settings)
                    $fields = array_merge($fields,$google_settings);
            }
        }
        return $fields;
    }

    public static function scripts(): string
    {
        
        $scripts = '
            <script>

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
                                console.log(appear);
                                $("."+appear+" input").prop( "disabled", false );
                                $("."+appear+" select").prop( "disabled", false );
                                $("."+appear).show();
                            }
                        }

                    });
                }

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
            </script>
        ';

        return $scripts;
    }
    
    public static function group(): string
    {
        return 'google';
    }
    
    public static function encrypted(): array
    {
        return [
            
        ];
    }
}
