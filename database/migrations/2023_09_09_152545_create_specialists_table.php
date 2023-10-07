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
        Schema::create('specialists', function (Blueprint $table) {
            $table->char('specialist_id',6)->primary();
            $table->string('name_en',255);
            $table->string('name_th',255);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('case_m_d_s', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->foreign('casetype_id')->references('casetype_id')->on('casetypes');
            $table->foreign('idcard')->references('idcard')->on('patients');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('caseid')->references('caseid')->on('case_m_d_s');
        });
    }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
