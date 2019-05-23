<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsycologicalMeeting extends Model
{

    protected $guarded = [];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
