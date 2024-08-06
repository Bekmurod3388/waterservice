<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SearchService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected ProductService $serviceProduct,
        protected SearchService $searchService,
    )
    {
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchColumn = 'name';

        $productsQuery = Product::query();
        $products = $this->searchService->applySearch($productsQuery, $search, $searchColumn)->paginate(10);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Servis muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $this->serviceProduct->update($request, $product);

        return back()->with('success', 'Servis muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        $Product->delete();

        return back()->with('success', 'Product muvaffaqiyatli oʻchirildi!');

    }
}
