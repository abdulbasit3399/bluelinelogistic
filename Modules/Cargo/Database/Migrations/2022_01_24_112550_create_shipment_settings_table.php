<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        $items = array(
            [
                "key"       =>  "def_tax",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_shipping_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_shipping_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_tax_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "latest_shipment_count",
                "value"      =>  "10",
            ],
            [
                "key"       =>  "is_date_required",
                "value"      =>  "1",
            ],
            [
                "key"       =>  "def_shipping_date",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "shipment_prefix",
                "value"      =>  "AWB",
            ],
            [
                "key"       =>  "shipment_code_count",
                "value"      =>  "5",
            ],
            [
                "key"       =>  "mission_prefix",
                "value"      =>  "MI",
            ],
            [
                "key"       =>  "mission_code_count",
                "value"      =>  "7",
            ],
            [
                "key"       =>  "is_def_mile_or_fees",
                "value"      =>  "2",
            ],
            [
                "key"       =>  "def_pickup_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_supply_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_mile_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_mile_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_mile_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_mile_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "mission_done_with_fees_received",
                "value"      =>  "1",
            ],
            [
                "key"       =>  "show_register_in_driver_app",
                "value"      =>  "1",
            ],
            [
                "key"       =>  "is_shipping_calc_required",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_shipment_type",
                "value"      =>  "1",
            ],
            [
                "key"       =>  "def_shipment_code_type",
                "value"      =>  "sequential",
            ],
            [
                "key"       =>  "def_shipment_conf_type",
                "value"      =>  "none",
            ],
            [
                "key"       =>  "default_shipment_code_number_type",
                "value"      =>  "random",
            ],
            [
                "key"       =>  "receiving_mission_confirmation_type",
                "value"      =>  "none",
            ],
            [
                "key"       =>  "def_package_type",
                "value"      =>  null,
            ],
            [
                "key"       =>  "def_branch",
                "value"      =>  null,
            ],
            [
                "key"       =>  "def_payment_method",
                "value"      =>  null,
            ],            
            
        );
        DB::table('shipment_settings')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_settings');
    }
}
