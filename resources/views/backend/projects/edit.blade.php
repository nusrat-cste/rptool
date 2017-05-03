@extends('backend.layouts.app')
@section('content')

<h1>Editing "{{ $project->project_name }}"</h1>
<p class="lead">Edit and save this task below, or <a href="{{ url('admin/projects')}}">go back to all tasks.</a></p>
<hr>


@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

{!! Form::model($project, [
    'method' => 'PATCH',
    'route' => ['admin.projects.update', $project->id]
]) !!}

<div class="form-group">
    {!! Form::label('project_name', 'project name:', ['class' => 'control-label']) !!}
    {!! Form::text('project_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('additional_info', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('additional_info', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Update project', ['class' => 'btn btn-primary']) !!}           
{!! Form::close() !!}

 <div class="pull-right">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['admin.projects.destroy', $project->id]
                ]) !!}
                 {!! Form::submit('Delete this Project?', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>




@stop