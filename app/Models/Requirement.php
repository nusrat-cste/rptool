<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $primaryKey = 'requirement_id';

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
