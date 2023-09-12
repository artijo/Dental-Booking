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
        Schema::create('supports', function (Blueprint $table) {
            $table->char('support_id',6)->primary();
            $table->string('name',255);
            $table->string('tel',10)->unique();
            $table->integer('level');
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
        Schema::table('supports', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
