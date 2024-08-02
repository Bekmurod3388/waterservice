<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function setLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $user = auth()->user();
        $user->update([
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'last_active_time' => now()
        ]);

//        User::query()->where('user_id', $userId)->update([
//            'latitude' => $request->get('latitude'),
//            'longitude' => $request->get('longitude'),
//            'last_active_time' => now()
//        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
