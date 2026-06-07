<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;

class CustomCakeController extends Controller
{
    public function index()
    {
        return view('custome_cake');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|string',
            'weight' => 'required|numeric',
            'details' => 'required|string',
            'sample_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('sample_image')) {
            $imagePath = $request->file('sample_image')->store('custom_orders', 'public');
        }

        CustomOrder::create([
            'event_type' => $request->event_type,
            'weight' => $request->weight,
            'details' => $request->details,
            'sample_image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your Custome order has been placed. We will contact you soon.');
    }
}
