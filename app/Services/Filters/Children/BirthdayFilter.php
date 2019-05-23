<?php


namespace App\Services\Filters\Children;


use App\Services\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class BirthdayFilter extends AbstractFilter
{
    public function filter(Builder $builder, string $value): Builder
    {
        return $builder->where('birthday', '=', $value);
    }
}
