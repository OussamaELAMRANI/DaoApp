<?php


namespace App\Services\Filters\Children;


use App\Services\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class RelationsFilter implements IFilter
{

    public function filter(Builder $builder, string $value): Builder
    {
        $relation = explode(',', $value);
        $relations = $this->ResolveFilterValue($relation);

        if (is_null($relations))
            return $builder;

        return $builder->with($relations);
    }

    public function mapping(): array
    {
        return [
            'meeting' => 'meeting',
            'educators' => 'educators',
        ];
    }

    public function ResolveFilterValue($keys)
    {
        $res = array();
        foreach ($keys as $key) {
            $res[] = data_get($this->mapping(), $key);
        }
        return array_filter($res);
    }
}
