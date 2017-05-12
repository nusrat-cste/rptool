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

                        @if(count($stakeholders) > 0)
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

                                     <td>
                                         <form action="{{ route('admin.projects.stakeholders.destroy', [ $project->id, $stakeholder->id ]) }}" method="post">
                                             <input type="hidden" name="_method" value="DELETE" />
                                             <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                             <input class="btn btn-sm btn-danger" type="submit" value="Remove">
                                         </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <br>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p>Currently, there is no stakeholders for this project. <a href="{{ route('admin.projects.stakeholders.create', $project->id) }}">Add one</a></p>
                                    </div>
                                </div>
                            </div>
                        @endif
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