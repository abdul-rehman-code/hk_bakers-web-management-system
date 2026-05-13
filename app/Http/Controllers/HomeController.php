<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get()->take(6);

        $featuredProducts = Product::where('is_active', true)
                                    ->take(12)
                                    ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }

    public function allCategories()
    {
        $categories = Category::where('is_active', true)->get();

        return view('all-categories', compact('categories'));
    }

    public function about()
    {
        return view('about-us');
    }

    public function contact()
    {
        return view('contact');
    }

    public function products(Request $request)
    {
        $products = $this->getProductQuery($request)->paginate(12);

        $onsaleproduct = Product::where('on_sale', true)
                                ->where('is_active', true)
                                ->latest()
                                ->take(5)
                                ->get();

        $categories = Category::where('is_active', true)
                              ->withCount('products')
                              ->get();

        return view('products', compact('products', 'onsaleproduct', 'categories'));
    }

    public function productsPartial(Request $request)
    {
        $products = $this->getProductQuery($request)->paginate(12);

        $html = view('partials.products-grid', compact('products'))->render();

        return response()->json([
            'html'        => $html,
            'total'       => $products->total(),
            'currentPage' => $products->currentPage(),
            'lastPage'    => $products->lastPage(),
        ]);
    }

   private function getProductQuery(Request $request)
{
    $query = Product::where('is_active', true);

    // --- Search Logic Start ---
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }
    // --- Search Logic End ---

    if ($request->filled('category')) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    // Sorting logic (Latest by default)
    if ($request->filled('sort_by')) {
        if ($request->sort_by == 'price_low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort_by == 'price_high_low') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }
    } else {
        $query->latest();
    }

    return $query;
}
    public function productDetails($slug)
{
    // Product dhoondein slug ke zariye, aur sath hi category ka data bhi le aayein
    $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

    // Related Products (Same category ke doosre products dikhane ke liye)
    $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->where('is_active', true)
                                ->take(4)
                                ->get();

    return view('product-details', compact('product', 'relatedProducts'));
}
}
