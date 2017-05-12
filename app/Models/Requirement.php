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

    public function stakeholders()
    {
        return $this->belongsToMany(Access\User\User::class, 'requirements_stakeholders', 'requirement_id', 'stakeholder_id');
    }

}
