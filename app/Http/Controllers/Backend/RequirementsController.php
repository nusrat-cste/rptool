<?php

namespace App\Http\Controllers\Backend;

use App\Models\Access\User\User;
use App\Models\Feedback;
use App\Models\Project;
use App\Models\Requirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;

class RequirementsController extends Controller
{
    /**
     * @var Project
     */
    private $project;
    /**
     * @var Requirement
     */
    private $requirement;

    /**
     * RequirementsController constructor.
     * @param Project $project
     * @param Requirement $requirement
     */
    public function __construct(Project $project, Requirement $requirement)
    {
        $this->project = $project;
        $this->requirement = $requirement;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $projectId

     * @return \Illuminate\Http\Response
     */
    public function erpimplform($projectId)
    {
        $data = [
            'requirements' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['requirements'] = $data['project']->requirements;

        $userId = access()->user()->id;

        $feedbacks = Feedback::where('stakeholder_id', $userId)
                            ->where('project_id', $projectId)
                            ->get();

        if (count($feedbacks)) {
            $data['feedbacks'] = $feedbacks;
        }

        return view('backend.requirements.erpimplform', $data);

    }

    /**
     * Display a listing of the resource.
     *
     * @param $projectId

     * @return \Illuminate\Http\Response
     */
    public function reprotizer($projectId){
         $data = [
            'requirements' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['requirements'] = $data['project']->requirements;
        $data['stakeholders'] = $data['project']->stakeholders;

        $adminIds = User::whereHas('Roles', function ($q) {
            $q->where('name', 'Administrator');
        })->pluck('id');

        $noS    = count($data['project']->stakeholders); //number of stakeholder - assume 3
        $noR    = count($data['project']->requirements); //number of requirements - assume 4

        $userFeedbacks = Feedback::where('project_id', $projectId)->select('*')
                                    ->whereNotIn('stakeholder_id', $adminIds)
                                    ->groupBy('stakeholder_id')->get();

        $noF = count($userFeedbacks);

        $feedbacks = Feedback::where('project_id', $projectId)->select('*')
                                ->whereNotIn('stakeholder_id', $adminIds)
                                ->get();

        $weights = [];

        if(count($feedbacks) < 2) {
            return redirect()->route('admin.projects.show', $projectId)->with('flash_warning', 'Minimum two stakeholder need to submit their feedback.');
        }

        foreach ($feedbacks as $feedback) {
            $weights[$feedback->stakeholder_id][$feedback->requirement_id] = $feedback->weight;
//            $weights[$feedback->stakeholder_id][] = $feedback->weight;
        }

//        dd($weights);
//        $weights = array_values($weights);

        $sumArray = [];
        $rowSum=[];


        // first, multiply the weights with $noF

        foreach ($weights as $key1 => $weight) {
            foreach ($weight as $k2 => $wg) {
                $weights[$key1][$k2] = $wg * $noF;
            }
        }

//        dd($result1);
        // then, divide the result with $noR
        foreach ($weights as $key2 => $resultValue) {
            foreach ($resultValue as $k2 => $rslt) {
                $weights[$key2][$k2] = $rslt / $noR;
            }
        }

//        dd($weights);

        // now, square the result
        // and then sum the total weight square result for individual stakeholders
        $sumTotalWeights = [];
        $sumValue = 0;

        foreach ($weights as $key3 => $sqresultValue) { // stakeholders
            foreach ($sqresultValue as $k3 => $sqrslt) { // weight
                $weights[$key3][$k3] = $sqrslt * $sqrslt;
                $sumValue += $weights[$key3][$k3];
            }
            $sumTotalWeights[$key3] = $sumValue;
            $sumValue = 0;
        }

//        dd($sumTotalWeights);
//        dd($weights);
        // divide individual weight square with the sum result
        foreach ($weights as $key4 => $value) { // stakeholders
            foreach ($value as $k4 => $val) { // weight
                $weights[$key4][$k4] = $val / $sumTotalWeights[$key4];
            }
        }

//        dd($weights);


        $sumFinal = 0;
        $rowFinal = [];
        $columnFinal = [];
        // sum s1[w] + s2[w]

        foreach ($weights as $k => $v) {
            foreach ($v as $ky => $item) {
                $rowFinal[$ky][$k] = $item;
            }
        }

        foreach ($rowFinal as $rowKey => $requirement) {
            foreach ($requirement as $k => $stackholder) {
                $sumFinal += $stackholder;
            }
            $columnFinal[$rowKey]['reprotizer'] = $sumFinal;
            $sumFinal = 0;
        }

//        dd($columnFinal);
        $data['final'] = $columnFinal;
//        dd($data);

/*        $requirementIds = array_keys($data['final']);
        $requirements = Requirement::whereIn('requirement_id', $requirementIds)
                                            ->select('requirement_id', 'requirement_name')->get()->toArray();

        $requirementWithName = [];
                dd($requirements);
        foreach ($requirements as $requirement) {
            $requirementWithName[$requirement['requirement_id']]['requirement_name'] = $requirement['requirement_name'];
        }
        dd($requirementWithName);*/


        // previous code
/*
        for ($row = 0; $row < $noF; $row++)  //row=number of stakeholder
        {
            $tempSum=0;

            for ($col = 0; $col < $noR; $col++) //col=number of requirements
            {
                $temp                   = $weights[$row][$col] * $noF;
                $div                    = $temp/$noR;
                $weights[$row][$col]    = $div;
                $square                 = $weights[$row][$col] * $weights[$row][$col] ;
                $sumArray[$row][$col]   = $square;

                $tempSum += $square;
            }

            $rowsum[$row] = $tempSum;

            for($k = 0; $k< $noR ; $k++){          //k=number of requirements
                 $tempVal           =$sumArray[$row][$k] / $rowsum[$row];
                $sumArray[$row][$k] = $tempVal;

                $number=$sumArray[$row][$k];
                $precision = 3;
            }
        }

        for($i=0; $i< $noR; $i++){          //i=number of requirements
            $Sum = 0;
            for($j=0; $j< $noF; $j++){      //j=number of stakeholders
                $Sum += $sumArray[$j][$i];
            }
            $sumArry[$i] = $Sum;
            $final[$i]=$sumArry[$i];
            sort($final);
        }

        $data['noR']        = $noR;
        $data['final']      = $final;
        $data['precision']  = $precision;*/

        return view('backend.requirements.reprotizer', $data);
    }

    public function erpimpl($projectId)
    {
        $data = [
            'requirements' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        /* For multiple admins */
/*        $adminIds = User::whereHas('Roles', function ($q) {
            $q->where('name', 'Administrator');
        })->pluck('id');*/

        $data['feedbacks'] = Feedback::where('stakeholder_id', access()->user()->id)->where('project_id', $projectId)->get();

        $data['requirements'] = $data['project']->requirements;

//        foreach ($feedbacks as $feedback) {
//            $data['impl'][$feedback->requirement_id] = $feedback->implResult;
//        }
//
//        dd($data['impl']);

       // $noS    = count($data['project']->stakeholders); //number of stakeholder - assume 3
        $data['noR']    = count($data['project']->requirements); //number of requirements - assume 4
        
        return view('backend.requirements.erpimpl', $data);
    }

    public function implByAdmin(Request $request, $id)
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

                $requirementData[$requirementId] = [];

                $requirementData[$requirementId]['project_id']        = $id;
                $requirementData[$requirementId]['business_value']    = $businessValueArray[$key];
                $requirementData[$requirementId]['effort']            = $effortArray[$key];
                $requirementData[$requirementId]['alternatives']      = $alternativesArray[$key];
                $requirementData[$requirementId]['reusability']       = $reusabilityArray[$key];
                $requirementData[$requirementId]['weight']            = $weightArray[$key];
            }

            $user->requirements()->wherePivot('project_id', $project->id)->sync($requirementData);
        } else {
            throw new \Exception('You are not supposed to do that!');
        }

        //is it possible to redirect based on different user?

        return redirect()->route('admin.projects.show', $id)
            ->with('flash_success', 'Your feedback has been submitted successfully!');


    }


    public function index($projectId)
    {
        $data = [
            'requirements' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['requirements'] = $data['project']->requirements;

        return view('backend.requirements.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        return view('backend.requirements.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $projectId)
    {
        $data = $request->except('_token');

        $project = $this->project->find($projectId);

        if( ! $project instanceof $this->project) {
            abort(404);
        }

        $requirement = new $this->requirement;
        $requirement->fill($data);
        $project->requirements()->save($requirement);

        return redirect()->route('admin.projects.requirements.index', $project->id)->with('flash_success', 'New Requirement added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \laravel 5 boilerplate\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $projectId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $ \laravel 5 boilerplate\Models\Requirement  $requirement
     */
    public function edit($projectId, $id)
    {
        
        $data['requirement'] = $this->requirement->find($id);

        $data['project'] = $this->project->find($projectId);

        $data['requirements'] = $data['project']->requirements;

        return view('backend.requirements.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \laravel 5 boilerplate\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId, $id)
    {
        $requirement = $this->requirement->find($id);
        $project = $this->project->find($projectId);


        $input = $request->all();

        $requirement->fill($input)->save();


       Session::flash('flash_message', 'requirement successfully Updated!');

        return redirect()->route('admin.projects.requirements.index', $project->id)->with('flash_message', 'requirement successfully Updated!'); //return to show all req
    //Redirect::to('/admin/projects')->with('message', 'successfully added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \laravel 5 boilerplate\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $id)
    {

        $project = $this->project->find($projectId);
        $requirement = $this->requirement->find($id);

        $requirement->stakeholders()->detach();
        $requirement->delete();

      return redirect()->route('admin.projects.requirements.index', $project->id)->with('flash_message', 'requirement successfully deleted!'); //return to show all req
    //Redirect::to('/admin/projects')->with('message', 'successfully added!');
    }
}
