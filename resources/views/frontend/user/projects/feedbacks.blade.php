@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">

                    <div class="row">


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><strong>Project: {{ $project->project_name or '(not set)' }}</strong></h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <!-- This is the place where we will be going to add the form -->

<form action="{{ url('...') }}" method="POST">

     <table>
          <tr>
            <th>Requirements</th>
            <th>Business value</th>
            <th>Effort</th>
            <th>Alternatives</th>
            <th>Reusability</th>
            <th>Priority No.</th>
          </tr>

           @foreach($requirements as $requirement)
           <tr>
            <td>
            <strong>{{$requirement -> requirement_name}}</strong>
            </td>
            <td>
            <form>
            <strong>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="business_value" >

              </form>
            </strong>
            </td>
            <td>
            <form>
           <strong>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="effort" >
              </form>
            </strong>
            </td>
             <td>
             <form>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="alternatives" >
              </form>
            </strong>
            </td>
             <td>
           <strong>
              <form >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="reusability" >
              </form>
            </strong>
            </td>
             <td>
           <strong>
              <form>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="weight" >
              </form>
            </strong>
            </td>
  
          </tr>
          @endforeach
          </table>
         <input type="submit" value="Submit">

      </form>
                                              
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->

                        </div><!--col-md-8-->

                    </div><!--row-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@section('after-styles')
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
input {
   width: 60px;
   height: 25px;
 }
</style>
@endsection