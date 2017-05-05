@extends('backend.layouts.app')

@section('page-header')
    <h1>
        <strong>RPTOOL</strong>
        <small>Admin panel</small>
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
        <h2>{{$project->project_name}}</h2><br/>
        {{$project->additional_info}}<br/>
        </div>

        <div class="box box-title">
        <h4>Requirements</h4>
            <button class="btn btn-primary btn-md" >
                <i class="fa fa-plus"></i> <strong>Add Requirement</strong>
            </button>
            <button class="btn btn-primary btn-md" >
                <strong>Show Requirements</strong>
            </button>
            <br/>
        </div><!-- /.box-body -->

        <div class="box box-title">
        <h4>Stakeholders</h4>
            <button class="btn btn-primary btn-md" >
                <i class="fa fa-plus"></i> <strong>Add Stakeholders</strong>
            </button>
            <button class="btn btn-primary btn-md" >
                <strong>Show Stakeholders</strong>
            </button>
        </div><!-- /.box-body -->
         <div class="box box-success">
            <h3>Calculate priority</h3>
            <button class="btn btn-primary btn-md" >
            <strong>ERP IMPL</strong>
            </button>
            <button class="btn btn-primary btn-md" >
            <strong>Reprotizer</strong>
            </button>
            <br/>
        </div><!-- /.box-body -->
        <br/>
        <div class="pull-right">
        <button class="btn btn-primary btn-lg" >
            <strong>Requirement Prioritization Form</strong>
            </button>
        </div>

    <!--box box-success-->
@endsection