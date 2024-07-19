<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Filter::all();
        return view('filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        Filter::create($request->all());

        return redirect()->route('filter.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filter $filter)
    {
        return view('filter.edit', compact('filter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filter $filter)
    {
        request()->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        $filter->update($request->all());

        return redirect()->route('filter.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filter $filter)
    {

        $filter->delete();

        return redirect()->route('filter.index');

    }
}
