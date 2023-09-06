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
        Schema::create('casetypes', function (Blueprint $table) {
            $table->char('casetype_id',6)->primary();
            $table->string('casetype_name',255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casetypes');
        Schema::table('casetypes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
