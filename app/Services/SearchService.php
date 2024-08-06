<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class SearchService
{
    /**
     * Apply search filter to the query.
     *
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    public function applySearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
