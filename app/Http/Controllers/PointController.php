<?php

namespace App\Http\Controllers;

use App\Http\Requests\Points\StoreRequest;
use App\Http\Requests\Points\UpdateRequest;
use App\Models\Filter;
use App\Models\Point;
use App\Models\Region;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($client)
    {
        return view('points.index', [
            'points' => Point::with('client')->where('client_id', $client)->paginate(10),
            'regions' => Region::all(),
            'filters' => Filter::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, $client)
    {
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
    public function update(UpdateRequest $request, $client, Point $point)
    {
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
        $data=[];
        $m=0;
        $tasks = Task::query()->where('is_completed',0)->get();
        $points =  Point::query()->where('filter_expire_date', '<=', now())->get();
        for($i = 0; $i<count($tasks);$i++){
            for($j=0; $j<count($points);$j++){
                if($tasks[$i]->point_id!==$points[$j]->id){
                    $data[$m] = $points[$j];
                    $m++;
                }
            }
        }
        return view('points.work_list', [
            'agents' => User::role('agent')->get(),
            'services' => Service::all(),
            'points'=>$data
        ]);
    }
}
