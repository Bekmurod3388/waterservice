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
            'points' => Point::all(),
            'regions' => Region::all(),
            'filters' => Filter::all()
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
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        //
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
