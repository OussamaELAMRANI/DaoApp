<?php


namespace App\Services\Filters\Children;


use App\Services\Filters\FilterAbstract;

class ChildFilter extends FilterAbstract
{
    protected $filters = [
        'civility' => AccessFilter::class,
        'birthday' => BirthdayFilter::class,
        'name' => NameFilter::class,
        'with' => RelationsFilter::class,
    ];

}
