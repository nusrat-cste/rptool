@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Projects</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

        {{$project->id}}<br/>
        {{$project->project_name}}
            <br/>
            <button class="btn btn-primary btn-md" >
                <i class="fa fa-plus"></i> <strong>Add Requirement</strong>
            </button>
            <div class="pull-right">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['admin.projects.destroy', $project->id]
                ]) !!}
                    {!! Form::submit('Delete this task?', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>


        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection