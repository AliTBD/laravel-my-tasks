@extends('layout.layout')

@section('title', $project->project_name)

@section('content')

    {{ $project->description }}
    <br>
    <div>
        <br>
        @if($project->tasks->count() > 0)
            <br>
            <table class="table table-hover table-bordered">
                <thead class="thead">
                <tr>
                    <th scope="col" colspan="3">
                        <div class="text-center">Tasks</div>
                    </th>
                </tr>
                <tr>
                    <th scope="col">Done</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->tasks as $task)
                    <tr class={{ $task['done'] === 1 ? 'table-success' : 'table-danger' }}>
                        <td>
                            <form method="POST" action="/projects/{{$project->id}}/tasks/{{$task->id}}">
                                @method('PATCH')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="done" name="done" onchange="this.form.submit()" {{ $task['done'] === 1 ? 'checked' : '' }}>
                                </div>
                            </form>
                        </td>
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
            <div class="border border-dark rounded-lg" style="padding: 25px;">
                <h5 class="text-dark text-center">Project progress</h5>
                <br>
                <div id="piechart" class='d-flex justify-content-center'></div>
            </div>
        @else
            There is no tasks !!
            <br>
        @endif
        <br>
        <div class="border border-dark rounded-lg" style="padding: 25px;">
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

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Complete'],
                ['Completed task',       {{ $project->tasks->where('done', 1)->count() }}],
                ['Incomplete task',      {{ $project->tasks->where('done', 0)->count() }}]
            ]);

            var options = {
                width: '100%',
                height: '100%',
                colors: ['#008000', '#f00']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

@endsection
