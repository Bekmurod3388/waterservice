<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Point;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;
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
            'expire' => 'required|int',
        ]);

        Point::query()->create([
            'client_id' => $client,
            'region_id' => $request->get('region_id'),
            'address' => $request->get('address'),
            'filter_id' => $request->get('filter_id'),
            'filter_expire_month' => now()->addMonths((int)$request->get('expire'))
        ]);

        return redirect()->back()->with('success', 'Manzil muvaffaqiyatli yaratildi!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Point $point)
    {
        //
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
        $services = Service::all();
        $agents = User::role('agent')->get();
        $points = Point::query()->
        where('filter_expire_month' ,'<', now())->get();
        return view('points.work_list',['points'=>$points, 'agents'=>$agents,'services'=>$services]);
    }
}
