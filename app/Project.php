<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($name, $desc)
    {

        return Task::create(
            [
                'task_name'   => $name,
                'description' => $desc,
                'project_id'  => $this->id
            ]
        );
    }

    /*public function getOwner()
    {
        return $this->belongsTo(User::class);
    }*/

}
