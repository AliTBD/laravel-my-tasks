<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = collect();
        $projects = Project::where('owner_id', auth()->id())->get();

        foreach ($projects as $project){
            foreach ($project->tasks as $task){
                $tasks->push($task);
            }
        }

        return view('tasks.tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //Task::create(request(['name','desc']));


        request()->validate(
            ['name' => ['required', 'min:3', 'max:255'],
             'desc' => ['required', 'min:3', 'max:255']
            ]);


        $task              = new Task();
        $task->task_name   = request('name');
        $task->description = request('desc');

        $task->save();

        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        $project = $task->project;

        abort_unless($project->owner_id === auth()->id(), 403);

        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $project = $task->project;

        abort_unless($project->owner_id === auth()->id(), 403);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate(
            ['name' => ['required', 'min:3', 'max:255'],
             'desc' => ['required', 'min:3', 'max:255']
            ]);

        $task = Task::findOrFail($id);

        $task->task_name   = request('name');
        $task->description = request('desc');

        if (request('done') === '1') {
            $task->done = request('done');
        } else {
            $task->done = 0;
        }


        $task->save();

        return redirect('projects/' . $task->project_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('projects/' . $task->project_id);
    }
}
