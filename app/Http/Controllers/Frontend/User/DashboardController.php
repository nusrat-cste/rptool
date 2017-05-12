<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;
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
        $user =  access()->user();

        $data['projects'] = $user->projects;

        return view('frontend.user.dashboard', $data);
    }

    public function projectFeedback($id)
    {

         $data = [
            'requirements' => [],
        ];

        $data['project'] = Project::find($id);

        $data['topRatedProjects'] = Project::orderBy('created_at', 'desc')->limit(4)->get();

        $data['requirements'] = $data['project']->requirements;


        return view('frontend.user.projects.feedbacks', $data);
    }

    public function feedbackByUser(Request $request, $id)
    {
        $project = Project::find($id);

        if( ! $project instanceof Project) {
            abort(404);
        }

        $inputs = $request->except('_token');

        if (\Auth::check()) {
            $user = access()->user();
        } else {
            throw new \Exception('User is not logged in!');
        }

        if($request->has('requirement_id')) {
            $requirementIdArray = $inputs['requirement_id'];
            $businessValueArray = $inputs['business_value'];
            $effortArray        = $inputs['effort'];
            $alternativesArray  = $inputs['alternatives'];
            $reusabilityArray   = $inputs['reusability'];
            $weightArray        = $inputs['weight'];

            foreach ($requirementIdArray as $requirementId) {
                $key = array_search($requirementId, $requirementIdArray);

                $requirementData['project_id']        = $id;
                $requirementData['business_value']    = $businessValueArray[$key];
                $requirementData['effort']            = $effortArray[$key];
                $requirementData['alternatives']      = $alternativesArray[$key];
                $requirementData['reusability']       = $reusabilityArray[$key];
                $requirementData['weight']            = $weightArray[$key];

                $user->requirements()->attach($requirementId, $requirementData);
            }

        } else {
            throw new \Exception('You are not supposed to do that!');
        }

        return redirect()->route('frontend.user.dashboard')
                        ->with('flash_success', 'Your feedback has been submitted successfully!');
    }
}
