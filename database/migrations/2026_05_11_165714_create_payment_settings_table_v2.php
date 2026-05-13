<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agar galti se table pehle se bana ho toh delete kar ke naya banaye
        Schema::dropIfExists('payment_settings');

        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('method_name');      // JazzCash / EasyPaisa
            $table->string('account_number');    // Phone Number
            $table->string('account_holder');    // Name
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
