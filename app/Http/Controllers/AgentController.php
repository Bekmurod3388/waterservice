<?php

namespace App\Http\Controllers;

use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\Task;
use App\Models\User;
use App\Services\AgentProductService;
use Illuminate\Http\Request;
use App\Http\Requests\AgentProducts\StoreRequest;
use App\Http\Requests\AgentProducts\UpdateRequest;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function __construct(
        protected AgentProductService $productService
    )
    {
    }

    public function index(Request $request)
    {
        checkPermission('all_agents');

        $search = $request->input('search');

        $agentQuery = User::role('agent')
            ->withCount([
                'tasks as incomplete_tasks' => function ($query) {
                    $query->where('is_completed', 0);//->whereDate('created_at', today()->format('Y-m-d'))
                },
                'tasks as complete_tasks' => function ($query) {
                    $query->where('is_completed', 1);//->whereDate('created_at', today()->format('Y-m-d'))
                }
            ]);

        if ($search) {
            $agentQuery->where(function($query) use ($search) {
                $query->whereAny(['id', 'name', 'phone'], 'LIKE', "%$search%");
            });

            $agentQuery->orWhereHas('tasks', function ($query) use ($search) {
                $query->whereAny(['is_completed'], 'LIKE', "%$search%");
            });
        }

        $agents = $agentQuery->paginate(10);

        return view('agents.index', [
            'agents' => $agents,
        ]);
    }

    public function products(User $agent){
        $agent_products = AgentProduct::query()->where('agent_id',$agent->id)->paginate(10);
        $products = Product::all();
        return view('agents.products.index',['agent_products'=>$agent_products,'products'=>$products,'agent'=>$agent]);
    }
    public function product_store(StoreRequest $request, User $agent){
        $res = $this->productService->create($request->validated(),$agent);
        return redirect()->route('agent.products', [$agent->id])->with($res);
    }
    public function product_update(UpdateRequest $request, User $agent, AgentProduct $product){
        $res = $this->productService->update($request->validated(),$agent, $product);
        return redirect()->back()->with($res['key'], $res['message']);
    }
    public function agent_tasks(User $agent){
        return view('agents.tasks.index',[
            'tasks' => Task::with('point', 'client')->where('agent_id', $agent->id)->get()
        ]);
    }
}
