<?php

namespace App\Filters;


use Closure;
use Illuminate\Database\Eloquent\Builder;

readonly class NameFilter extends Filter
{
    public function handle(Builder $query, Closure $next): Builder
    {
        if ($this->value !== null) {
            $query->where('name', 'ILIKE', "%{$this->value}%");
        }

        return $next($query);
    }
}
