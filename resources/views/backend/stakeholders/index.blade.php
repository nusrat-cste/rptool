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
            <h3 class="box-title">{{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">



            <div class="col-md-offset-2 col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Showing all stakeholders of {{ $project->project_name or 'Undefined' }}</h3>

                        <div class="box-tools">

                            <a class="btn btn-success btn-md" href="{{ route('admin.projects.stakeholders.create', $project->id) }}">
                                <i class="fa fa-plus-circle"></i> <strong>Add New Stakeholder</strong>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Stakeholder Name</th>
                                <th>Stakeholder Email</th>
                            </tr>

                            @foreach($stakeholders as $key => $stakeholder)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $stakeholder->name or '(not set)' }}</td>
                                <td>
                                    <span>{{ $stakeholder->email or '(not set)' }}</span>
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
                    </div>
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