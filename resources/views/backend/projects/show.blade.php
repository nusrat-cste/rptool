@extends('backend.layouts.app')

@section('page-header')
    <h1>
        <strong>{{ app_name() }}</strong>
        <small>Admin panel</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Project Details</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <h4>Name of the Project : {{$project->project_name}}</h4>

        <p>{{$project->additional_info}}</p><br/>
        </div>

        <div class="box box-title">
        <h4>Requirements of {{ $project->project_name or 'Undefined' }}</h4>

            <a class="btn btn-primary btn-md" href="{{ route('admin.projects.requirements.create', $project->id) }}">
                <i class="fa fa-plus-circle"> Add new Requirement</i>
            </a>

            <a class="btn btn-info btn-md" href="{{ route('admin.projects.requirements.index', $project->id) }}">
                <i class="fa fa-arrow-circle-o-right"> Show all Requirements</i>
            </a>
            <br/>
        </div><!-- /.box-body -->

        <div class="box box-title">
        <h4>Stakeholders</h4>

            <a class="btn btn-primary btn-md" href="{{ route('admin.projects.stakeholders.create', $project->id) }}">
                <i class="fa fa-plus-circle"> Add Stakeholder</i>
            </a>

            <a class="btn btn-warning btn-md" href="{{ route('admin.projects.stakeholders.index', $project->id) }}">
                <i class="fa fa-address-book-o"> Show all Stakeholders</i>
            </a>
        </div><!-- /.box-body -->

          <div class="box box-success">
            <h3>ERP IMPL form</h3>
            <a class="btn btn-primary btn-md" href="{{ url('admin/projects/'.$project->id.'/erpimplform') }}">
            <strong>ERP IMPL</strong>
            </a>
            <br/>
        </div><!-- /.box-body -->
        <br/>
        
         <div class="box box-success">
            <h3>Calculate priority</h3>
            <a class="btn btn-primary btn-md" href="{{ url('admin/projects/'.$project->id.'/erpimpl') }}">
            <strong>ERP IMPL</strong>
            </a>
             <a class="btn btn-primary btn-md" href="{{ url('admin/projects/'.$project->id.'/reprotizer') }}">
            <strong>Reprotizer</strong>
            </a>
            <br/>
        </div><!-- /.box-body -->

        

    <!--box box-success-->
@endsection