<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clients\StoreRequest;
use App\Http\Requests\Clients\UpdateRequest;
use App\Models\Client;
use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected SearchService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchColumn = 'name';

        $clientsQuery = Client::with('operator')
            ->withCount('tasks')
            ->filterByOperator();

        $clients = $this->service->applySearch($clientsQuery, $search, $searchColumn)
            ->paginate(10);

        return view('clients.index', [
            'clients' => $clients,
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
