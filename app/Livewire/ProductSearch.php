<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
   public function render()
{
    $products = [];
    if (strlen($this->search) >= 2) {
        $products = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }
    return view('livewire.product-search', [
        'products' => $products
    ]);
}
}
