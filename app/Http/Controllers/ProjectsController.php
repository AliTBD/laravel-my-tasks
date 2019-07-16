<?php

namespace App\Http\Controllers;

use App\Mail\ProjectCreated;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Mail;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $projects = Project::where('owner_id', auth()->id())->get();

        return view('projects.projects', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        request()->validate(
            ['name' => ['required', 'min:3', 'max:255'],
             'desc' => ['required', 'min:3', 'max:255']
            ]);


        $project               = new Project();
        $project->project_name = request('name');
        $project->description  = request('desc');
        $project->owner_id     = auth()->id();

        $project->save();

        Mail::to(auth()->user()->email)->send(new ProjectCreated($project));


        return redirect('projects');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('view', $project);

        //abort_unless($project->owner_id === auth()->id(), 403);

        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('view', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        request()->validate(
            ['name' => ['required', 'min:3', 'max:255'],
             'desc' => ['required', 'min:3', 'max:255']
            ]);

        $project = Project::findOrFail($id);

        $this->authorize('view', $project);

        $project->project_name = request('name');
        $project->description  = request('desc');

        /*if (request('done') === '1') {
            $project->done = request('done');
        } else {
            $project->done = 0;
        }*/
        $project->save();

        return redirect('projects');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('view', $project);

        foreach ($project->tasks as $task) {
            $task->delete();
        }

        $project->delete();

        return redirect('projects');
    }
}
