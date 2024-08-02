<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function logs()
    {
        return view('logs', [
            'logs' => Log::query()->latest()->paginate(15)
        ]);
    }
}
