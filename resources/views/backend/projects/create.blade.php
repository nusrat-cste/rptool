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
            <h3 class="box-title">Add Projects</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

            <form action="{{ url('admin/projects') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                Project Name:<br>
                <input type="text" name="project_name" >
                <br>
                Project Info:<br>
                <input type="text" name="additional_info" >
                <br><br>
                <input type="submit" value="Submit">
            </form>



        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection