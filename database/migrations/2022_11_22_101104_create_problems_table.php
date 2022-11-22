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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->float('d_log');
            $table->float('d_lat');
            $table->text('details');

            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();

            $table->foreignId('product_models_id')->nullable();
            $table->foreign('product_models_id')->on('users')->references('id')->cascadeOnDelete();

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
        Schema::dropIfExists('problems');
    }
};
