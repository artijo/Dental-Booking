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
        Schema::create('doctors', function (Blueprint $table) {
            $table->char('doctor_id',6)->primary();
            $table->string('name_en',255);
            $table->string('lastname_en',255);
            $table->string('name_th',255);
            $table->string('lastname_th',255);
            $table->string('email',255);
            $table->string('password',255);
            $table->string('tel',10);
            $table->char('specialist_id',6);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
