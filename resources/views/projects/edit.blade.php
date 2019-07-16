@extends('layout.layout')

@section('title', 'Edit project')

@section('content')
    <form method="post" action="/projects/{{$project->id}}" style="margin-bottom: 1em;">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="projectName">Project name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" name="name" placeholder="Enter project name" value="{{ $project->project_name }}">
        </div>
        <div class="form-group">
            <label for="taskDesc">Project description</label>
            <input type="text" class="form-control {{ $errors->has('desc') ? 'border-danger' : '' }}" name="desc" placeholder="Enter project description" value="{{ $project->description }}">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Project</button>
    </form>

    <form method="post" action="/projects/{{$project->id}}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger btn-block">Delete Project</button>
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
