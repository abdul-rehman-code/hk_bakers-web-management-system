<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('custom_orders', function (Blueprint $table) {
        $table->id();
        $table->string('event_type'); // Wedding, Birthday etc
        $table->text('details');      // User ki description
        $table->string('sample_image')->nullable(); // Image path
        $table->decimal('weight', 8, 2); // 1, 1.5, 2 etc
        $table->string('status')->default('pending'); // pending, accepted, completed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};
