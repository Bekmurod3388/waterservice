<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clients\StoreRequest;
use App\Http\Requests\Clients\UpdateRequest;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $operatorDealerId = Auth::id();
        $startOfMonth = Carbon::now()->startOfMonth();

        if (checkPermission('own_clients')) {
            $query = Client::with('operator')
                ->withCount('tasks')
                ->where('operator_dealer_id', $operatorDealerId)
                ->where('created_at', '>=', $startOfMonth);
        }
        elseif (checkPermission('all_clients')) {
            $query = Client::with('operator')
                ->withCount('tasks')
                ->where('created_at', '>=', $startOfMonth);
        }
        else {
            abort(403);
        }


        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereAny(['id', 'name', 'phone', 'description'], 'LIKE', "%$search%");
            });

            $query->orWhereHas('operator', function ($query) use ($search) {
                $query->whereAny(['name'], 'LIKE', "%$search%");
            });
        }

        $clients = $query->paginate(10);

        return view('clients.index', [
            'clients' => $clients,
            'operators' => User::role('operator_dealer')->get(),
            'clientCount' => $clients->total(),
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
