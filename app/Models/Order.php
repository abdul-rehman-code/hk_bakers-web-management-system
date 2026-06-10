<?php

namespace App\Models;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status',
        'delivery_address',
        'city',
        'nearby_landmark',
        'delivery_date',
        'delivery_time_slot',
        'customer_name',
        'customer_phone',
        'notes',
        'payment_method',
        'payment_screenshot'
    ];
    public function items(): HasMany
{
    return $this->hasMany(OrderItem::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
 public function products()
{
    // Pehla parameter: Product Model
    // Dusra parameter: Aapki table ka asal naam (e.g., 'order_items')
    return $this->belongsToMany(Product::class, 'order_items')
                ->withPivot('quantity'); // Agar quantity bahi show karni hai
}
}
