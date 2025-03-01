<?php

namespace App\Filters;


use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract readonly class Filter
{
    public function __construct(protected mixed $value)
    {
    }

    abstract public function handle(Builder $subscribers, Closure $next): Builder;
}
