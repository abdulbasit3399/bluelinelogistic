<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('key')->nullable();
            $table->string('name');
            $table->tinyInteger('is_archived')->default(0);
            $table->timestamps();
        });

        $items = array(
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "sender_request",
                "name"      =>  "Sender Request",
            ],
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "receiver_request",
                "name"      =>  "Receiver Request",
            ],
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "receiver_didn't_answer",
                "name"      =>  "Receiver Didn't Answer",
            ]
        );
        DB::table('reasons')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reasons');
    }
}
