<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgentProduct;
use App\Models\Point;
use App\Models\Product;
use App\Models\Service;
use App\Models\Task;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function getDemos()
    {
        return response()->json([
            'demos' => Point::query()
                ->with('client:id,name,phone,description')
                ->where('dealer_id', auth()->id())
                ->where('status', Point::STATUS_NEW)
                ->get()
        ]);
    }

    public function cancel(Request $request, Point $point)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $point->update([
            'dealer_comment' => $request->get('comment'),
            'status' => Point::STATUS_CANCEL
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function sold(Request $request, Point $point)
    {
        $request->validate([
            'agent_id' => 'required|int',
            'filter_id' => 'required|int',
            'filter_expire' => 'required|int',
            'is_full_pay' => 'required|bool',
        ]);

        Task::query()->create([
            'client_id' => $point->client_id,
            'point_id' => $request->get('point_id'),
            'agent_id' => $request->get('agent_id'),
            'user_id' => auth()->id() // bu joyda diller id

        ]);

        $point->update([
            'status' => Point::STATUS_AGENT
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
