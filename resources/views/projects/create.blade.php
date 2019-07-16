@extends('layout.layout')

@section('title', 'Create a new project')

@section('content')
    <form method="post" action="/projects">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="projectName">Project name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                   name="name" placeholder="Enter project name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="projectDesc">Project description</label>
            <input type="text" class="form-control {{ $errors->has('desc') ? 'border-danger' : '' }}"
                   name="desc" placeholder="Enter project description" value="{{ old('desc') }}">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Create Project</button>
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
