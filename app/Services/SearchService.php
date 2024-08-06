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
     * @param string $column
     * @return Builder
     */
    public function applySearch(Builder $query, ?string $search, string $column): Builder
    {
        if ($search) {
            $query->where($column, 'like', '%' . $search . '%');
        }

        return $query;
    }
}
