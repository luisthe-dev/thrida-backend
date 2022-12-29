<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('deposit_method');
            $table->float('min_amount')->default(10);
            $table->float('max_amount')->default(99999);
            $table->longText('deposit_details');
            $table->longText('deposit_image');
            $table->longText('deposit_logo');
            $table->integer('no_of_uses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
};
