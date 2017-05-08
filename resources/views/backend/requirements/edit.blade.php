@extends('backend.layouts.app')
@section('content')

<h1>Editing "{{ $requirement->requirement_name }}"</h1>
<p class="lead">Edit and save this requirement below, or <a href="{{ url('admin/projects/'.$project->id.'/requirements')}}">go back to all requirements.</a></p>
<hr>

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

{!! Form::model($requirement, [
    'method' => 'PATCH',
     'route' => [ 'admin.projects.requirements.update',$project->id,$requirement->requirement_id ]

]) !!}

<div class="form-group">
    {!! Form::label('requirement_name', 'requirement name:', ['class' => 'control-label']) !!}
    {!! Form::text('requirement_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Update requirement', ['class' => 'btn btn-primary']) !!}           
{!! Form::close() !!}

 <div class="pull-right">
                {{ Form::open(array('route' => array('admin.projects.requirements.destroy', $project->id,$requirement->requirement_id), 'method' => 'delete')) }}

                 {!! Form::submit('Delete this requirement?', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>





@stop