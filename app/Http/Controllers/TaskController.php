<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\Task;
use App\Models\TaskService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'point_id' => 'required|exists:points,id',
            'agent_id' => 'required|exists:users,id',
            'service_ids' => 'array',
            'comment' => 'nullable|string',
            'service_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        DB::transaction(function() use ($request) {
            // Fetching the services and calculating the total cost
            $services = Service::query()->whereIn('id', $request->get('service_ids') ?? [])->pluck('cost', 'id')->toArray();
            $servicesTotalCost = Service::query()->whereIn('id', $request->get('service_ids') ?? [])->sum('cost');

            // Creating the task with the provided data
            $task = Task::query()->create([
                'client_id' => $request->get('client_id'),
                'point_id' => $request->get('point_id'),
                'agent_id' => $request->get('agent_id'),
                'user_id' => auth()->id(),                                 //Taskni kim biriktirdi? (operator agentni idsi)
                'service_cost_sum' => $servicesTotalCost,                  //Taskning ummumiy summasi
                'comment' => $request->get('comment'),      //Agent taskni bajarish uchun qachan borishi garak?
                'service_time' => $request->get('service_time'),      //Agent taskni bajarish uchun qachan borishi garak?
                'cash' => 0,                                               //Migration da nullabale qilib yoki default 0 barib berdan o`chirish garak
                'card' => 0,                                               //Migration da nullabale qilib yoki default 0 barib berdan o`chirish garak
                'terminal' => 0,                                           //Migration da nullabale qilib yoki default 0 barib berdan o`chirish garak
                'transfer' => 0,                                           //Migration da nullabale qilib yoki default 0 barib berdan o`chirish garak
            ]);

            // Creating TaskService records for each selected service
            foreach ($request->get('service_ids') ?? [] as $service_id) {
                TaskService::query()->create([
                    'task_id' => $task->id,
                    'agent_id' => $request->get('agent_id'),
                    'service_id' => $service_id,
                    'service_cost' => $services[$service_id],
                    'is_free' => 0                                       //Migrationda default barib berdan o`chirish garak
                ]);
            }
        });

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->query()->delete();
        return redirect()->back();

    }

    public function clientTasks(Client $client)
    {
        checkPermission('client_tasks');

        return view('tasks.client_tasks', [
            'client' => $client,
            'tasks' => Task::with('client', 'point', 'user')->where('client_id', '=', $client->id)->get(),
            'agents' => User::role('agent')->get(),
            'action' => 'clients.tasks.create'
        ]);
    }

    public function clientTasksCreate(Request $request)
    {
        Task::query()->create([
            'client_id' => $request->get('client_id'),
            'point_id' => $request->get('point_id'),
            'agent_id' => $request->get('agent_id'),
        ]);

        return redirect()->back();
    }
}
