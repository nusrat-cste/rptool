@extends('backend.layouts.app')

@section('page-header')
   <h1>
        <strong>{{ app_name() }}</strong>
        <small>ERP IMPL</small>
    </h1>
@endsection

@section('content')
 <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Prioritized requirements of {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>

        <div class="box box-success">
            <table id="dt-table" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Requirement Name</th>
                        <th>Prioritize Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $key => $feedback)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $feedback->requirement->requirement_name }}</td>
                            <td>{{ $feedback->implResult }}</td>
                        </tr>
                        <br/>
                    @endforeach
                </tbody>
            </table>
        </div><!--box box-success-->


@endsection

@section('after-styles')
     <link rel="stylesheet" href="{{ asset('css/backend/plugin/datatables/dataTables.bootstrap.min.css') }}" />
@endsection

@section('after-scripts')
     <script src="{{ asset('js/backend/plugin/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('js/backend/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>

         <script>
//             $('#dt-table').DataTable({
//                 "bPaginate": false
//             });
             $(function () {
                 $('#dt-table').DataTable({
                     "paging": true,
                     "lengthChange": true,
                     "ordering": true,
                     "info": false,
                     "autoWidth": false,
                     "iDisplayLength": 20
                 });
             });
         </script>
@endsection