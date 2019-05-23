<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educators extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function children()
    {
        return $this->morphedByMany(Child::class, 'educatorsable', 'educatorsables');
    }

}
