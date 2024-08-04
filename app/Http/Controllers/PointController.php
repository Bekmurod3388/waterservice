<?php

namespace App\Http\Controllers;

use App\Http\Requests\Points\StoreRequest;
use App\Http\Requests\Points\UpdateRequest;
use App\Models\Point;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use App\Models\Task;
use App\Models\TaskReason;
use App\Models\User;
use Illuminate\Http\Request;

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
            'products' => Product::all(),
            'dealers' => User::role('dealer')->pluck('name', 'id')
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
            'dealer_id' => $request->get('dealer_id'),
            'demo_time' => $request->get('demo_time'),
            'comment' => $request->get('comment'),
            'filter_id' => $request->get('filter_id'),
            'filter_expire' => $request->get('filter_expire'),
            'filter_expire_date' => $request->get('filter_expire') ? now()->addMonths((int)$request->get('filter_expire')) : null
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
            'dealer_id' => $request->get('dealer_id'),
            'demo_time' => $request->get('demo_time'),
            'comment' => $request->get('comment'),
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

    public function workList()
    {
        $tasks = Task::query()->where('is_completed', 0)->pluck('point_id')->toArray();
        $points = Point::with('lastReason')
            ->whereDate('filter_expire_date', '<=', now())
            ->whereNotIn('id', $tasks)
            ->get();

        return view('points.work_list', [
            'agents' => User::role('agent')->get(),
            'services' => Service::all(),
            'points' => $points
        ]);
    }

    public function changeExpireDate(Request $request, Point $point)
    {
        $point->filter_expire_date = $request->filter_expire_date;
        $point->save();

        TaskReason::query()->create([
            'point_id' => $point->id,
            'filter_expire_date'=>$request->filter_expire_date,
            'reason'=>$request->reason
        ]);

        return redirect()->route('work.list')->with('success', 'Manzil muvaffaqiyatli yaratildi!');
    }
}
