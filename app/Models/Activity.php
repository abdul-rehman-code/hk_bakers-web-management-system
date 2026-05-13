<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    // Ye columns mass assignment ke liye allow honge
    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];
// app/Models/Activity.php
public static function log($action, $description)
{
    self::create([
        'user_id' => auth()->id() ?? 1, // Agar user login nahi to ID 1 (admin)
        'action' => $action,
        'description' => $description,
    ]);
}
    // User ke sath relationship (taake activity dikhate waqt user ka naam mil sakay)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
