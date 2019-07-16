@extends('layout.layout')

@section('title', 'Create a new task')

@section('content')
    <form method="post" action="/tasks">
        {{ csrf_field() }}
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
        <button type="submit" class="btn btn-primary btn-block">Create Task</button>
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
