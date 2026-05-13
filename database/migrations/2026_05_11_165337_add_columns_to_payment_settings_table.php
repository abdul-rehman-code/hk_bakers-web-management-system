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
    Schema::table('payment_settings', function (Blueprint $table) {
        // Check karein jo columns missing hain wo yahan add karein
        if (!Schema::hasColumn('payment_settings', 'method_name')) {
            $table->string('method_name')->nullable();
        }
        if (!Schema::hasColumn('payment_settings', 'account_number')) {
            $table->string('account_number')->nullable();
        }
        if (!Schema::hasColumn('payment_settings', 'account_holder')) {
            $table->string('account_holder')->nullable();
        }
        if (!Schema::hasColumn('payment_settings', 'is_active')) {
            $table->boolean('is_active')->default(true);
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            //
        });
    }
};
