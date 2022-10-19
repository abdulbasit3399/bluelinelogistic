<?php

namespace Modules\Payments\Entities;

use Spatie\LaravelSettings\Settings;

class PaymentSetting extends Settings
{
    public $paypal_payment;
    public $paystack;
    public $sslcommerz_payment;
    public $instamojo_payment;
    public $razorpay;
    public $stripe_payment;
    public $voguepay;
    public $payhere;
    public $ngenius;
    public $iyzico;
    public $cash_payment;
    public $invoice_payment;


    public static function fields(): array
    {
        $settings = app(PaymentSetting::class);

        $fields = [];
        $all_modules = array_map('basename', \Illuminate\Support\Facades\File::directories(base_path('Modules')) );

        $payments = array();
        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            if(check_module($module_name)){
                $payments = config("$module_name.payments");
                if($payments)
                    $fields = array_merge($fields,$payments);
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
        return 'payments';
    }
    
    public static function encrypted(): array
    {
        return [
            
        ];
    }
}
