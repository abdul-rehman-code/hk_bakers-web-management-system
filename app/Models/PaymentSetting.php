<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'method_name',
        'account_number',
        'account_holder',
        'is_active',
    ];

    public function up()
{
    Schema::create('payment_settings', function (Blueprint $table) {
        $table->id();
        $table->string('method_name')->default('JazzCash');
        $table->string('account_number');
        $table->string('account_holder');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
}
