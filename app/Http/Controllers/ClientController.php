<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clients\StoreRequest;
use App\Http\Requests\Clients\UpdateRequest;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::with('operator')->withCount('tasks')->filterByOperator()->paginate(10),
            'operators' => User::role('operator_dealer')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Client::query()->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'telegram_id' => $data['telegram_id'],
            'description' => $data['description'],
            'operator_dealer_id' => auth()->id()
        ]);

        return back()->with('success', 'Mijoz muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        return back()->with('success', 'Mijoz muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index');
    }
}
