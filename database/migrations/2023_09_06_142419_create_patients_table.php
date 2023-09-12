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
        Schema::create('patients', function (Blueprint $table) {
            $table->char('idcard',13)->primary();
            $table->string('name_en',255)->nullable();
            $table->string('lastname_en',255)->nullable();
            $table->string('name_th',255);
            $table->string('lastname_th',255);
            $table->string('email',255)->nullable()->unique();
            $table->string('tel',10)->unique();
            $table->string('gender',6);
            $table->date('birthday');
            $table->longText('intolerance')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
        Schema::table('patients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
