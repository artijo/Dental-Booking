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
        Schema::create('bookings', function (Blueprint $table) {
            $table->char('booking_id',10)->primary();
            $table->char('caseid',8);
            $table->string('booking_title',255);
            $table->longText('booking_detail')->nullable();
            $table->dateTime('booking_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
