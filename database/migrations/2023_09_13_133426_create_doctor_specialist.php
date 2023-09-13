<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_specialist', function (Blueprint $table) {
            $table->id();
            $table->char(column:'doctor_id');
            $table->char(column:'specialist_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->foreign('specialist_id')->references('specialist_id')->on('specialists');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_specialist');
    }
};
