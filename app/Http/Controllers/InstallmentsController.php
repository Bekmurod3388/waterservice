<?php

namespace App\Http\Controllers;

use App\Models\Installments;
use Illuminate\Http\Request;

class InstallmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $installments = [];
        return view('installments.index',[
            'installments' => $installments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Installments $installments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installments $installments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installments $installments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installments $installments)
    {
        //
    }
}
