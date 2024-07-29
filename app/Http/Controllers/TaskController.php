<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\Task;
use App\Models\TaskService;
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
            'client_id' => 'required|int',
            'point_id' => 'required|int',
            'user_id' => 'required|int',
            'service_ids' => '',
        ]);

        DB::transaction(function() use ($request) {
            $services = Service::query()->whereIn('id', $request->get('service_ids'))->pluck('cost', 'id')->toArray();

            $task = Task::query()->create([
                'client_id' => $request->get('client_id'),
                'point_id' => $request->get('point_id'),
                'user_id' => $request->get('user_id')
            ]);

            foreach ($request->get('service_ids') as $service_id) {
                TaskService::query()->create([
                    'task_id' => $task->id,
                    'user_id' => $request->get('user_id'),
                    'service_id' => $service_id,
                    'service_cost' => $services[$service_id]
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

        dd('test');
        $task->delete();
        return redirect()->back();

    }

    public function clientTasks(Client $client)
    {
        return view('tasks.client_tasks', [
            'client' => $client,
            'tasks' => Task::with('client', 'point', 'user')->where('client_id', '=', $client->id)->get(),
            'action' => 'clients.tasks.create'
        ]);
    }

    public function clientTasksCreate(Request $request)
    {
        Task::query()->create([
            'client_id' => $request->get('client_id'),
            'user_id' => auth()->id(),
            'point_id' => 1,
        ]);

        return redirect()->back();
    }
}
