<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Project;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['projects'] = Project::orderBy('created_at', 'desc')->paginate(10);

        $data['topRatedProjects'] = Project::orderBy('created_at', 'desc')->limit(4)->get();

        return view('frontend.user.dashboard', $data);
    }

    public function projectFeedback($id)
    {
        $data['project'] = Project::find($id);

        $data['topRatedProjects'] = Project::orderBy('created_at', 'desc')->limit(4)->get();

        return view('frontend.user.projects.feedbacks', $data);
    }
}
