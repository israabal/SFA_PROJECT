<?php

use App\Models\ProblemStatus;
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
        Schema::create('repair_problems', function (Blueprint $table) {
            $table->id();
            $table->text('details');
            $table->foreignId(ProblemStatus::class);
            $table->foreignId('problem_id');
            $table->foreign('problem_id')->on('problems')->references('id')->cascadeOnDelete();
            $table->foreignId('repair_id');
            $table->foreign('repair_id')->on('repairs')->references('id')->cascadeOnDelete();
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
        Schema::dropIfExists('repair_problems');
    }
};
