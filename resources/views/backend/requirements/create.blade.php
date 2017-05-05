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
            <h3 class="box-title">Add New Requirement for {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

            <form action="{{ route('admin.projects.requirements.store', $project->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                Requirement Name:<br>
                <input type="text" name="requirement_name" >
                <br>

                Requirement details:<br>
                <textarea name="description" id="" cols="30" rows="10"></textarea>
                <br><br>
                <input type="submit" value="Submit">
            </form>



        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection