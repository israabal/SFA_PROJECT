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
        Schema::create('maintinance_apps', function (Blueprint $table) {
            $table->id();
            $table->enum('app_status',['pending', 'accepted', 'refused']);
            $table->float('d_log');
            $table->float('d_lat');
            $table->boolean('active')->default(true);
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();

            $table->foreignId('technecal_id')->nullable();
            $table->foreign('technecal_id')->on('users')->references('id')->cascadeOnDelete();
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
        Schema::dropIfExists('maintinance_apps');
    }
};
