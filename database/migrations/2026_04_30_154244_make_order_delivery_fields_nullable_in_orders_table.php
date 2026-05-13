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
        Schema::table('orders', function (Blueprint $table) {
            $table->date('delivery_date')->nullable()->change();
            $table->string('delivery_time_slot')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->text('delivery_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('delivery_date')->nullable(false)->change();
            $table->string('delivery_time_slot')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->text('delivery_address')->nullable(false)->change();
        });
    }
};
