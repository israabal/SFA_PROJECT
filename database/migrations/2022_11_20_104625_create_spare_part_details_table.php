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
        Schema::create('spare_part_details', function (Blueprint $table) {
            $table->id();
            $table->string('value',20);
            $table->string('unit',20);
            $table->foreignId('spare_part_id')->constrained()->restrictOnDelete();
            $table->foreignId('product_model_id')->constrained()->restrictOnDelete();
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
        Schema::dropIfExists('spare_part_details');
    }
};
