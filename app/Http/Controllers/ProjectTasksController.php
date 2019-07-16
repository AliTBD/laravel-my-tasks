<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Task;

class ProjectTasksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Project $project, Task $task)
    {
        $task->update(
            [
                'done' => request()->has('done')
            ]);

        return back();
    }

    public function store(Project $project)
    {
        request()->validate(
            ['name' => ['required', 'min:3', 'max:255'],
             'desc' => ['required', 'min:3', 'max:255']
            ]);

        $name = request()->name;
        $desc = request()->desc;
        $project->addTask($name, $desc);

        return back();
    }
}
