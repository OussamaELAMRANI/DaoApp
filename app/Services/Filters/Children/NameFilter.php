<?php


namespace App\Services\Filters\Children;


use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    public function filter(Builder $builder, string $value)
    {
        return $builder->where('first_name_fr', 'LIKE', "{$value}%");
    }
}
