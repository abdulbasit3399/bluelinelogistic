<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->double('exchange_rate')->default(0);
            $table->double('default')->default(0);
            $table->integer('status')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
        });

        $items = array(
            [
                "name"          =>  "U.S. Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  1.00000,
                "status"        =>  1,
                "code"          =>  "USD",
            ],
            [
                "name"          =>  "Australian Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  1.28000,
                "status"        =>  1,
                "code"          =>  "AUD",
            ],
            [
                "name"          =>  "Brazilian Real",
                "symbol"        =>  "R$",
                "exchange_rate" =>  3.25000,
                "status"        =>  1,
                "code"          =>  "BRL",
            ],
            [
                "name"          =>  "Canadian Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  1.27000,
                "status"        =>  1,
                "code"          =>  "CAD",
            ],
            [
                "name"          =>  "Czech Koruna",
                "symbol"        =>  "Kč",
                "exchange_rate" =>  20.65000,
                "status"        =>  1,
                "code"          =>  "CZK",
            ],
            [
                "name"          =>  "Danish Krone",
                "symbol"        =>  "kr",
                "exchange_rate" =>  6.05000,
                "status"        =>  1,
                "code"          =>  "DKK",
            ],
            [
                "name"          =>  "Euro",
                "symbol"        =>  "€",
                "exchange_rate" =>  0.85000,
                "status"        =>  1,
                "code"          =>  "EUR",
            ],
            [
                "name"          =>  "Hong Kong Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  7.83000,
                "status"        =>  1,
                "code"          =>  "HKD",
            ],
            [
                "name"          =>  "Hungarian Forint",
                "symbol"        =>  "Ft",
                "exchange_rate" =>  255.24000,
                "status"        =>  1,
                "code"          =>  "HUF",
            ],
            [
                "name"          =>  "Israeli New Sheqel",
                "symbol"        =>  "₪",
                "exchange_rate" =>  3.48000,
                "status"        =>  1,
                "code"          =>  "ILS",
            ],
            [
                "name"          =>  "Japanese Yen",
                "symbol"        =>  "¥",
                "exchange_rate" =>  107.12000,
                "status"        =>  1,
                "code"          =>  "JPY",
            ],
            [
                "name"          =>  "Malaysian Ringgit",
                "symbol"        =>  "RM",
                "exchange_rate" =>  3.91000,
                "status"        =>  1,
                "code"          =>  "MYR",
            ],
            [
                "name"          =>  "Mexican Peso",
                "symbol"        =>  "$",
                "exchange_rate" =>  18.72000,
                "status"        =>  1,
                "code"          =>  "MXN",
            ],
            [
                "name"          =>  "Norwegian Krone",
                "symbol"        =>  "kr",
                "exchange_rate" =>  7.83000,
                "status"        =>  1,
                "code"          =>  "NOK",
            ],
            [
                "name"          =>  "New Zealand Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  1.38000,
                "status"        =>  1,
                "code"          =>  "NZD",
            ],
            [
                "name"          =>  "Philippine Peso",
                "symbol"        =>  "₱",
                "exchange_rate" =>  52.26000,
                "status"        =>  1,
                "code"          =>  "PHP",
            ],
            [
                "name"          =>  "Polish Zloty",
                "symbol"        =>  "zł",
                "exchange_rate" =>  3.39000,
                "status"        =>  1,
                "code"          =>  "PLN",
            ],
            [
                "name"          =>  "Pound Sterling",
                "symbol"        =>  "£",
                "exchange_rate" =>  0.72000,
                "status"        =>  1,
                "code"          =>  "GBP",
            ],
            [
                "name"          =>  "Russian Ruble",
                "symbol"        =>  "руб",
                "exchange_rate" =>  55.93000,
                "status"        =>  1,
                "code"          =>  "RUB",
            ],
            [
                "name"          =>  "Singapore Dollar",
                "symbol"        =>  "$",
                "exchange_rate" =>  1.32000,
                "status"        =>  1,
                "code"          =>  "SGD",
            ],
            [
                "name"          =>  "Swedish Krona",
                "symbol"        =>  "kr",
                "exchange_rate" =>  8.19000,
                "status"        =>  1,
                "code"          =>  "SEK",
            ],
            [
                "name"          =>  "Swiss Franc",
                "symbol"        =>  "CHF",
                "exchange_rate" =>  0.94000,
                "status"        =>  1,
                "code"          =>  "CHF",
            ],
            [
                "name"          =>  "Thai Baht",
                "symbol"        =>  "฿",
                "exchange_rate" =>  31.39000,
                "status"        =>  1,
                "code"          =>  "THB",
            ],
            [
                "name"          =>  "Taka",
                "symbol"        =>  "৳",
                "exchange_rate" =>  84.00000,
                "status"        =>  1,
                "code"          =>  "BDT",
            ],
            [
                "name"          =>  "Indian Rupee",
                "symbol"        =>  "Rs",
                "exchange_rate" =>  68.45000,
                "status"        =>  1,
                "code"          =>  "Rupee",
            ]
        );
        DB::table('currencies')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
