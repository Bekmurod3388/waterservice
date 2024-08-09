<?php

namespace App\Http\Controllers;

use App\Models\Responsible;
use App\Models\User;
use App\Services\ResponsibleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Responsible\StoreRequest;
use App\Http\Requests\Responsible\UpdateRequest;
use function Symfony\Component\String\s;

class ResponsibleController extends Controller
{
    public function __construct(protected ResponsibleService $responsible){
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

//        $responsibles = Responsible::with('operator','cashier')->get();

        $responsible = Responsible::query()->with('operator','cashier');

        if($search){
            $responsible->where(function ($query) use ($search) {
                $query->whereAny(['id', 'cashier_id', 'operator_id','month'], 'LIKE', "%$search%");
            });

            $responsible->orWhereHas('operator', function ($query) use ($search) {
                $query->whereAny(['name'], 'LIKE', "%$search%");
            });

            $responsible->orWhereHas('cashier', function ($query) use ($search) {
                $query->whereAny(['name'], 'LIKE', "%$search%");
            });
        }


        $responsible = $responsible->paginate(10);


        foreach ($responsible as $val) {
            $val->month = Carbon::createFromFormat('Y-m-d', $val->month)->format('Y-m');
        }

        return view('responsible.index',[
            'responsible' => $responsible,
            'operators' => User::role('operator_cashier')->get(),
            'cashiers' => User::role('cashier')->get(),
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
    public function store(StoreRequest $request)
    {
        $this->responsible->store($request->validated());

        return back()->with('success', 'Muvaffaqiyatli biriktirildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Responsible $responsible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Responsible $responsible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Responsible $responsible)
    {
        $this->responsible->update($request->validated(), $responsible);

        return back()->with('success', 'Muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Responsible $responsible)
    {
        //
    }
}
