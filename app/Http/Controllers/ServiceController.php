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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $servicesQuery = Service::query();

        if ($search) {
            $servicesQuery->where(function ($query) use ($search) {
                $query->whereAny(['id', 'name', 'cost'], 'LIKE', "%$search%");
            });

            $servicesQuery->orWhereHas('tasks', function ($query) use ($search) {
                $query->whereAny(['name'], 'LIKE', "%$search%");
            });
        }

        $services = $servicesQuery->paginate(10);

        return view('services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Service::query()->create($request->all());

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
