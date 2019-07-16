@extends('layout.layout')

@section('title', 'My Projects')

@section('content')
    @if($projects->count() > 0)
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Project Name</th>
                <th scope="col">Project Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <th>
                        <a href="/projects/{{$project['id']}}">{{ $project['project_name'] }}</a>
                    </th>
                    <td>{{ $project['description'] }}</td>
                    <!-- $project['owner_id']-->
                <!--<td>$project->getOwner['id']</td>-->
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        There is no projects !!
        <br><br>
    @endif
    <a class="btn btn-primary btn-block" href="projects/create" role="button">Create a new project</a>
@endsection
