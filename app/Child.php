<?php

namespace App;

use App\Services\Filters\Children\ChildFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Child extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $req, array $filters = [])
    {
        return (new ChildFilter($req))->add($filters)->filter($builder);
    }

    public function scopeLast(Builder $builder)
    {
        return $builder->orderBy('id','desc')->get();
    }

    public function educators()
    {
        return $this->morphToMany('App\Educators', 'educatorsable', 'educatorsables');
    }

    public function meeting()
    {
        return $this->hasMany(PsycologicalMeeting::class);
    }

}
