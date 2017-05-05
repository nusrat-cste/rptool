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
            <h3 class="box-title">Add New Stakeholders to the Project: {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

            <form action="{{ route('admin.projects.stakeholders.store', $project->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @foreach($stakeholders as $stakeholder)
                <input type="checkbox" name="stakeholders[]" value="{{ $stakeholder->id }}" />{{ $stakeholder->name }}<br />
                @endforeach
                <input type="submit" value="Submit">
            </form>



        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection