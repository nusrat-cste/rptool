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
            <h3 class="box-title">Requirements of {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">



            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Showing all requirements of {{ $project->project_name or 'Undefined' }}</h3>

                        <div class="box-tools">

                            <a class="btn btn-success btn-md" href="{{ route('admin.projects.requirements.create', $project->id) }}">
                                <i class="fa fa-plus-circle"></i> <strong>Add New Requirement</strong>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Requirement Name</th>
                                <th>Description</th>
                                <th style="width: 120px">Action</th>
                            </tr>

                            @foreach($requirements as $key => $requirement)
                            <tr>
                                <td>{{ $requirement->requirement_id }}</td>
                                <td>{{ $requirement->requirement_name or '(Not set)' }}</td>
                                <td>
                                    <span>{{ str_limit($requirement->description, 50) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.requirements.edit', [$project->id, $requirement->requirement_id]) }}">
                                        <span class="badge bg-aqua">Edit</span>
                                    </a>
                                    {{--<span class="badge bg-red">Delete</span>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                    </br>
                    <!-- /.box-body -->
                        
                </div>

                <div class="box-tools">
                    <!-- place for pagination -->
                    <ul class="pagination pagination-sm no-margin pull-right">
                    </ul>
                </div>
                <!-- /.box -->
            </div>
        </div><!-- /.box-body -->
    </div><!--box box-success-->



@endsection