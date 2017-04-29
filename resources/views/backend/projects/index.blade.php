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
            
            @foreach($projects as $project)
            <br/>
                <a href="{{ url('admin/projects', $project->id) }}">
                    {{ $project->project_name or '' }}
                </a> <!-- This is the link to go to the specific project details -->
                <br/>  
             <a class="btn btn-primary btn-md" href="{{ url('admin/projects',$project->id) }}">
                <i class="fa fa-plus"></i> <strong>View details</strong>
              </a >
            <a class="btn btn-primary btn-md" href="{{ url('admin/projects/'.$project->id.'/edit') }}">
                <i class="fa fa-plus"></i> <strong>Edit</strong>
            </a>
             @endforeach
             <br/> 
             <br/>
              <a class="btn btn-primary btn-md" href="{{ url('admin/projects/create') }}">
                <i class="fa fa-plus"></i> <strong>Add New Project</strong>
            </a> 
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection