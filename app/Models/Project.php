<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = [];

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function feedbacks()
    {
        return $this->hasManyThrough(Feedback::class, Requirement::class, 'project_id', 'requirement_id');
    }

    public function stakeholders()
    {
        return $this->belongsToMany(Access\User\User::class, 'projects_stakeholders', 'project_id', 'stakeholder_id');
    }
}
