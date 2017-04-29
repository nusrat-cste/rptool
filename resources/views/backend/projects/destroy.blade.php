@extends('backend.layouts.app')

@section('content')

<h1>{{ $project->project_name }}</h1>
<p class="lead">{{ $project->additional_info }}</p>
<hr>

<div class="row">
    <div class="col-md-6">
        <a href="{{ url('admin/projects')}}" class="btn btn-info">Back to all Projects</a>
        <a href="{{ url('admin/projects/'.$project->id.'/edit') }}" class="btn btn-primary">Edit Project</a>
    </div>
    <div class="col-md-6 text-right">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['admin.projects.destroy', $project->id]
        ]) !!}
            {!! Form::submit('Delete this task?', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>

@stop