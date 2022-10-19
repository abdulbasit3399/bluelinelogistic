<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('status_id');
            $table->tinyInteger('type');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('shipping_date');
            $table->string('collection_time')->nullable();
            $table->integer('client_status')->default(1);
            $table->integer('client_id')->unsigned()->nullable();
            $table->text('client_phone');
            $table->text('client_address')->nullable();
            $table->text('client_street_address_map')->nullable();
            $table->text('client_lat')->nullable();
            $table->text('client_lng')->nullable();
            $table->text('client_url')->nullable();
            $table->text('reciver_street_address_map')->nullable();
            $table->text('reciver_lat')->nullable();
            $table->text('reciver_lng')->nullable();
            $table->text('reciver_url')->nullable();
            $table->text('reciver_phone')->nullable();
            $table->string('reciver_name')->nullable();
            $table->string('reciver_address')->nullable();
            $table->integer('from_country_id')->unsigned();
            $table->integer('from_state_id')->unsigned();
            $table->integer('from_area_id')->unsigned()->nullable();
            $table->integer('to_country_id')->unsigned();
            $table->integer('to_state_id')->unsigned();
            $table->integer('to_area_id')->unsigned()->nullable();
            $table->tinyInteger('payment_type')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->text('payment_integration_id')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->double('tax')->default(0);
            $table->double('insurance')->default(0);
            $table->string('delivery_time')->nullable();
            $table->double('shipping_cost')->default(0);
            $table->double('return_cost')->default(0);
            $table->double('total_weight')->default(0);
            $table->integer('amount_to_be_collected')->default(0);
            $table->integer('employee_user_id')->unsigned()->nullable();
            $table->text('attachments_before_shipping')->nullable();
            $table->text('attachments_after_shipping')->nullable();
            $table->integer('mission_id')->unsigned()->nullable();
            $table->integer('captain_id')->unsigned()->nullable();
            $table->integer('prev_branch')->nullable();
            $table->string('order_id')->nullable();
            $table->string('otp')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamps();
        });

        $items = array(
            [
                "type"      =>  "notifications",
                "key"       =>  "new_shipment",
                "Name"      =>  "New Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "update_shipment",
                "Name"      =>  "Update Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "new_captain",
                "Name"      =>  "New Captain",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "new_client",
                "Name"      =>  "New Client",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "new_staff",
                "Name"      =>  "New Staff",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "new_mission",
                "Name"      =>  "New Mission",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "mission_action",
                "Name"      =>  "Mission Action",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "shipment_action",
                "Name"      =>  "Shipment Action",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "aprroved_shipment",
                "Name"      =>  "Approved Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "reject_shipment",
                "Name"      =>  "Reject Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "assigned_shipment",
                "Name"      =>  "Assigned Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "received_shipment",
                "Name"      =>  "Received Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "deliverd_shipment",
                "Name"      =>  "Deliverd Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "supplied_shipment",
                "Name"      =>  "Supplied Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_shipment",
                "Name"      =>  "Returned Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_to_stock_shipment",
                "Name"      =>  "Returned To Stock",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_to_sender_shipment",
                "Name"      =>  "Returned To Sender",
            ],
            
        );
        DB::table('business_settings')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
