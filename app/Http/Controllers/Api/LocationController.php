<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Point;
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


    public function setPointLocation(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'point_id' => 'required|exists:points,id'
        ]);

        // Find the point by its ID
        $point = Point::find($request->input('point_id'));

        // Update the point's location
        $point->latitude = $request->input('latitude');
        $point->longitude = $request->input('longitude');

        // Save the changes
        $point->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Point location updated successfully',
            'point' => $point
        ]);
    }

}
