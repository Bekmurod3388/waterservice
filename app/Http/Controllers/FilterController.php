<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filters\StoreRequest;
use App\Http\Requests\Filters\UpdateRequest;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Filter::paginate(10);
        return view('filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Filter::create($request->all());

        return back()->with('success', 'Servis muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Filter $filter)
    {
        $filter->update($request->all());

        return back()->with('success', 'Servis muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filter $filter)
    {

        $filter->delete();

        return back()->with('success', 'Servis muvaffaqiyatli oʻchirildi!');

    }
}
