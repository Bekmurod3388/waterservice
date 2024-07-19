<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Point;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('points.index', [
            'points' => Point::with('client')->get(),
            'regions' => Region::all(),
            'filters' => Filter::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $client)
    {
        $request->validate([
            'region_id' => 'required',
            'address' => '',
            'filter_id' => 'required',
            'filter_expire' => 'required|int',
        ]);

        Point::query()->create([
            'client_id' => $client,
            'region_id' => $request->get('region_id'),
            'address' => $request->get('address'),
            'filter_id' => $request->get('filter_id'),
            'filter_expire' => $request->get('filter_expire'),
            'filter_expire_date' => now()->addMonths((int)$request->get('filter_expire'))
        ]);

        return redirect()->back()->with('success', 'Manzil muvaffaqiyatli yaratildi!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $client, Point $point)
    {
        $request->validate([
            'region_id' => 'required',
            'address' => '',
            'filter_id' => 'required',
            'filter_expire' => 'required|int',
        ]);

        // if changed expire cycle
        if ($request->get('filter_expire') != $point->filter_expire) {
            $point->filter_expire_date->subMonths($point->filter_expire)->addMonths((int)$request->get('filter_expire'));
            $point->update([
                'filter_expire_date' => $point->filter_expire_date->subMonths($point->filter_expire)->addMonths((int)$request->get('filter_expire'))
            ]);
        }

        $point->update([
            'client_id' => $client,
            'region_id' => $request->get('region_id'),
            'address' => $request->get('address'),
            'filter_id' => $request->get('filter_id'),
            'filter_expire' => $request->get('filter_expire')
        ]);

        return redirect()->back()->with('success', 'Manzil muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        //
    }

    public function work_list()
    {
        return view('points.work_list', [
            'agents' => User::role('agent')->get(),
            'services' => Service::all(),
            'points' => Point::query()->where('filter_expire_date', '<', now())->get(),
        ]);
    }
}
