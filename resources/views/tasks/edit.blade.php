@extends('layout.layout')

@section('title', 'Edit task')

@section('content')
    <form method="post" action="/tasks/{{$task->id}}" style="margin-bottom: 1em;">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="taskName">Task name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" name="name" placeholder="Enter task name" value="{{ $task->task_name }}">
        </div>
        <div class="form-group">
            <label for="taskDesc">Task description</label>
            <input type="text" class="form-control {{ $errors->has('desc') ? 'border-danger' : '' }}" name="desc" placeholder="Enter task description" value="{{ $task->description }}">
        </div>
        <label for="taskDone">Done</label>
        <input type="checkbox" name="done" value="1" {{ $task['done'] === 1 ? 'checked' : '' }}/>
        <button type="submit" class="btn btn-primary btn-block">Update Task</button>
    </form>

    <form method="post" action="/tasks/{{$task->id}}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger btn-block">Delete Task</button>
        <br>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

@endsection
