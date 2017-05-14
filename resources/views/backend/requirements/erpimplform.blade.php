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
            <h3 class="box-title">Priority form of {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>
        
    <form action="{{ route('admin.erpimpl.post', $project->id) }}" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="warning">
                    <th width="30%">Requirements</th>
                    <th>Business value</th>
                    <th>Effort</th>
                    <th>Alternatives</th>
                    <th>Reusability</th>
                </tr>
            </thead>

            <tbody>
                @foreach($requirements as $key => $requirement)
                    <tr>
                        <td width="30%">
                            <input type="hidden" name="requirement_id[]" value="{{ $requirement->requirement_id }}">
                            <strong>{{$requirement -> requirement_name}}</strong>
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value"
                                   name="business_value[]"
                                   value="{{ (isset($feedbacks) && $feedbacks[$key]->requirement_id == $requirement->requirement_id) ? $feedbacks[$key]->business_value : '' }}" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value"
                                   name="effort[]"
                                   value="{{ (isset($feedbacks) && $feedbacks[$key]->requirement_id == $requirement->requirement_id) ? $feedbacks[$key]->effort : '' }}" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="alternatives[]"
                                   value="{{ (isset($feedbacks) && $feedbacks[$key]->requirement_id == $requirement->requirement_id) ? $feedbacks[$key]->alternatives : '' }}" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="reusability[]"
                                   value="{{ (isset($feedbacks) && $feedbacks[$key]->requirement_id == $requirement->requirement_id) ? $feedbacks[$key]->reusability : '' }}" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success center-block">Submit</button>

</form>

    @endsection