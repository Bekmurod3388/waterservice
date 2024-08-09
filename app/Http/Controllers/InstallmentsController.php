<?php

namespace App\Http\Controllers;

use App\Models\Installments;
use Illuminate\Http\Request;

class InstallmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $installments = Installments::query()
            ->with('points', 'responsible.operator')
            ->whereHas('responsible', function ($query) {
                $query->where('operator_id', auth()->id());
            })
            ->where('is_finished', false)
            ->whereDate('payment_day', '<=', now());

        if ($search) {
            $installments->where(function ($query) use ($search) {
                $query->where('filter_cost', 'LIKE', "%$search%")
                    ->orWhere('period_month', 'LIKE', "%$search%")
                    ->orWhere('initial_fee', 'LIKE', "%$search%")
                    ->orWhere('remaining_amount', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%")
                    ->orWhere('payment_day', 'LIKE', "%$search%")
                    ->orWhereHas('responsible.operator', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('points', function ($query) use ($search) {
                        $query->where('address', 'LIKE', "%$search%");
                    });
            });
        }

        $installments = $installments->paginate(10);

        return view('installments.index', [
            'installments' => $installments,
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
    public function show(Installments $installments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installments $installments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installments $installments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installments $installments)
    {
        //
    }
}
