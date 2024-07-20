<?php

namespace App\Http\Controllers;

use App\Http\Requests\Services\StoreRequest;
use App\Http\Requests\Services\UpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('services.index', [
            'services' => Service::query()->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Service::create($request->all());

        return back()->with('success', 'Servis muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Service $service)
    {
        $service->update($request->all());

        return back()->with('success', 'Servis muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Servis muvaffaqiyatli oʻchirildi!');
    }
}
