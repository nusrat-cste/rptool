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

                                            @include('frontend.user.projects.feedback-form')
                                              
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
</style>
@endsection