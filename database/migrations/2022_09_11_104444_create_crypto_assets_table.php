<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('crypto_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->string('name');
            $table->string('symbol');
            $table->string('max_supply');
            $table->float('price', 15, 7);
            $table->string('market_cap');
            $table->float('percent_change_day');
            $table->float('percent_change_week');
            $table->float('percent_change_month');
            $table->float('percent_change_trimester');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crypto_assets');
    }
};
