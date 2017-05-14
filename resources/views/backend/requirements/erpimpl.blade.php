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

        @for($i = $noR - 1; $i>=0; $i--)    <!-- i=numofrequirement-1 -->
                            <br/>
                         {{ substr(number_format($sumArray[$i], $precision+1, '.', ''), 0, -1) }}
                        @endfor
           </div><!--box box-success-->


@endsection