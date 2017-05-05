@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-4 col-md-push-8">

                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <img class="media-object profile-picture" src="{{ $logged_in_user->picture }}" alt="Profile picture">
                                    </div><!--media-left-->

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            {{ $logged_in_user->name }}<br/>
                                            <small>
                                                {{ $logged_in_user->email }}<br/>
                                                Joined {{ $logged_in_user->created_at->format('F jS, Y') }}
                                            </small>
                                        </h4>

                                        {{ link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => 'btn btn-info btn-xs']) }}

                                        @permission('view-backend')
                                            {{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration'), [], ['class' => 'btn btn-danger btn-xs']) }}
                                        @endauth
                                    </div><!--media-body-->
                                </li><!--media-->
                            </ul><!--media-list-->

                        </div><!--col-md-4-->

                        <div class="col-md-8 col-md-pull-4">

                            <div class="row">

                                @if(count($projects))
                                @foreach($projects as $project)
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4> {{ $project->project_name or '(Not set)' }} </h4>
                                                <div>
                                                    <a class="btn btn-primary btn-sm pull-right" href="{{ route('frontend.user.dashboard.project.details', $project->id) }}">
                                                        View details <i class="fa fa-angle-double-right"></i>
                                                    </a>
                                                </div>
                                            </div><!--panel-heading-->

                                            <div class="panel-body">
                                                <p>{{ str_limit($project->additional_info, 60) }}</p>
                                            </div><!--panel-body-->
                                        </div><!--panel-->
                                    </div><!--col-md-6-->
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <div class="panel panel-default">

                                            <div class="panel-body">
                                                <p>Sorry, currently there is no project available for you.</p>
                                            </div><!--panel-body-->
                                        </div><!--panel-->
                                    </div><!--col-md-12-->
                                @endif

                                <div class="pull-right">
                                    {{--{{ $projects->links() }}--}}
                                </div>
                            </div><!--row-->

                        </div><!--col-md-8-->

                    </div><!--row-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection
