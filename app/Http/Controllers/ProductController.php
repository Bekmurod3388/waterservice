<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Services\ProductHistoryCreateService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $productHistoryCreateService;

    public function __construct(ProductHistoryCreateService $productHistoryCreateService){
        $this->productHistoryCreateService = $productHistoryCreateService;
    }

    public function index()
    {
        return view('products.index', [
            'products' => Product::paginate(10),
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
        $product = Product::create($request->validated());

        $this->productHistoryCreateService->create($product);

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
        $this->productHistoryCreateService->update($request,$product);
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
