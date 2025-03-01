<?php

namespace App\Filters;


use Closure;
use Illuminate\Database\Eloquent\Builder;

readonly class PriceMaxFilter extends Filter
{
    public function handle(Builder $query, Closure $next): Builder
    {
        if ($this->value !== null) {
            $query->where('price', '<=', $this->value);
        }

        return $next($query);
    }
}
