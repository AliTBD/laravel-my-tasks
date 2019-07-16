@extends('layout.layout')

@section('title', 'My tasks')

@section('content')
    @if($tasks->count() >0)
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Task Name</th>
                <th scope="col">Task Description</th>
                <th scope="col">Project name</th>
                <th scope="col">Done</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class={{ $task['done'] === 1 ? 'table-success' : 'table-danger' }}>
                    <th>
                        {{ $task['task_name'] }}
                    </th>
                    <td>{{ $task['description'] }}</td>
                    <td>
                        <a href="/projects/{{ $task->project['id'] }}">{{ $task->project['project_name'] }}</a>
                    </td>
                    </td>
                    <td scope="row">
                        <input type="checkbox" name="done" {{ $task['done'] === 1 ? 'checked' : '' }} onclick="return false;"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        There is no tasks !!
        <br>
    @endif

@endsection
