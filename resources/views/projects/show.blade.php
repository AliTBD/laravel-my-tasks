@extends('layout.layout')

@section('title', $project->project_name)

@section('content')

    {{ $project->description }}
    <br><br><br>
    <div>
        <h5>Tasks:</h5>
        <br>
        @if($project->tasks->count() > 0)
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Done</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->tasks as $task)
                    <tr class={{ $task['done'] === 1 ? 'table-success' : 'table-danger' }}>
                        <th>
                            <form method="POST" action="/projects/{{$project->id}}/tasks/{{$task->id}}">
                                @method('PATCH')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="done" name="done" onchange="this.form.submit()" {{ $task['done'] === 1 ? 'checked' : '' }}>
                                </div>
                            </form>
                        </th>
                        <td>
                            <a href="/tasks/{{$task['id']}}">{{ $task['task_name'] }}</a>
                        </td>
                        <td scope="row">
                            {{ $task['description'] }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            There is no tasks !!
            <br>
        @endif
        <br>
        <div class="border border-secondary rounded-lg" style="padding: 25px;">
            <form method="POST" action="/projects/{{$project->id}}/tasks">
                @csrf
                <h5 style="text-align: center;">Create a new Task</h5>
                <div class="form-group">
                    <label for="taskName">Task name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                           name="name" placeholder="Enter task name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="taskDesc">Task description</label>
                    <input type="text" class="form-control {{ $errors->has('desc') ? 'border-danger' : '' }}"
                           name="desc" placeholder="Enter task description" value="{{ old('desc') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Task</button>
            </form>
        </div>
        <br><br>
    </div>

    <form method="get" action="/projects/{{$project->id}}/edit">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">Edit Project</button>
    </form>

@endsection
