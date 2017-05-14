@extends('backend.layouts.app')

@section('page-header')
   <h1>
        <strong>{{ app_name() }}</strong>
        <small>Reprotizer</small>
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
        <div class="box-body">
            <div class="col-md-12">
                <div class="col-md-9 col-md-offset-3">
                    <!-- This is where the algorithm will be resulted -->
                    <h4>Prioritized list</h4>

                    <table id="dt-table" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th style="width: 10px">Requirement ID</th>
                            <th>Requirement Name</th>
                            <th>Prioritize Rank</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($final as $key => $item)
                            <tr>
                                <td>{{ $key }}</td>
                                @php
                                    $requirement = \App\Models\Requirement::find($key);
                                @endphp
                                <td>{{ $requirement->requirement_name or '' }}</td>
                                <td>{{ number_format($item['reprotizer'], 4) }}</td>
                            </tr>
                            <br/>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box-tools">
                    <!-- place for pagination -->
                    <ul class="pagination pagination-sm no-margin pull-right">

                    </ul>
                </div>
        </div><!-- /.box-body -->
    </div><!--box box-success-->


@endsection

@section('after-styles')
    <link rel="stylesheet" href="{{ asset('css/backend/plugin/datatables/dataTables.bootstrap.min.css') }}" />
@endsection

@section('after-scripts')
    <script src="{{ asset('js/backend/plugin/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/backend/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            $('#dt-table').DataTable({
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "iDisplayLength": 20
            });
        });
    </script>
@endsection