<?php


namespace App\Services\Filters\Children;


use App\Services\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class AccessFilter implements IFilter
{
    public function filter(Builder $builder, string $value): Builder
    {
        return $builder->where('civility', '=', $this->ResolveFilterValue($value));
    }

    public function mapping(): array
    {
        return [
            'Masculin' => 'M',
            'Feminin' => 'F',
        ];
    }

    public function ResolveFilterValue($key)
    {
        return data_get($this->mapping(), $key);
    }
}

