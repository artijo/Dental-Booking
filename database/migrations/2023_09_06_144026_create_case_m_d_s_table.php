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
        Schema::create('case_m_d_s', function (Blueprint $table) {
            $table->char('caseid',8)->primary();
            $table->char('doctor_id',6)->foreign('doctor_id')->references('doctor_id')->on('doctors');
            $table->char('idcard',13)->foreign('idcard')->references('idcard')->on('patients');
            $table->string('case_title',255);
            $table->longText('case_detail')->nullable();
            $table->integer('case_status');
            $table->char('casetype_id')->foreign('casetype_id')->references('casetype_id')->on('casetypes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_m_d_s');
        Schema::table('case_m_d_s', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
