<?php

namespace App\Http\Controllers;

use App\Models\AgentProduct;
use App\Models\Product;
use App\Models\User;
use App\Services\AgentProductService;
use Illuminate\Http\Request;
use App\Http\Requests\AgentProducts\StoreRequest;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function __construct(
        protected AgentProductService $service
    )
    {
    }
    public function index()
    {
        $agents = User::role('agent')
            ->withCount([
                'tasks as incomplete_tasks' => function ($query) {
                    $query->where('is_completed', 0);//->whereDate('created_at', today()->format('Y-m-d'));
                },
                'tasks as complete_tasks' => function ($query) {
                    $query->where('is_completed', 1);//->whereDate('created_at', today()->format('Y-m-d'));
                }
            ])
            ->paginate(10);

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
        $res = $this->service->create($request->validated(),$agent);
        return redirect()->route('agent.products', [$agent->id])->with($res);
    }
}
