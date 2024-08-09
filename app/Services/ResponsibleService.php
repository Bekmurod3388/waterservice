<?php

namespace App\Services;

use App\Models\Responsible;
use Carbon\Carbon;

class ResponsibleService
{
    /**
     * Create a new class instance.
     */
    public function store($data)
    {
        $data['month']=Carbon::createFromFormat('Y-m', $data['month'])->startOfMonth()->format('Y-m-d');
        Responsible::query()->create($data);
    }

    public function update($data, $responsible)
    {
        $data['month']=Carbon::createFromFormat('Y-m', $data['month'])->startOfMonth()->format('Y-m-d');
        $responsible->update($data);
    }
}
