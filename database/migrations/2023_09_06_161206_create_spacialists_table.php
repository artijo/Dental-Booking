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
        Schema::create('spacialists', function (Blueprint $table) {
            $table->char('spacialist_id',6)->primary();
            $table->string('name_en',255);
            $table->string('name_th',255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spacialists');
        Schema::table('spacialists', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
