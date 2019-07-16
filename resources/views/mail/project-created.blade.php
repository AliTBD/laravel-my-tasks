@component('mail::message')
# You created a new project: {{$project->project_name}}

{{$project->description}}

@component('mail::button', ['url' => url('/projects/' . $project->id)])
View project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
