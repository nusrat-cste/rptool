<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'requirements_stakeholders';

    public function getImplResultAttribute($value)
    {
        return ($this->reusability * $this->business_value) / ($this->effort * $this->alternatives) ;
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id', 'requirement_id');
    }
}
