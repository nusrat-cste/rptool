<?php

namespace App\Http\Controllers\Backend;

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

        $noS    = count($data['project']->stakeholders); //number of stakeholder - assume 3
        $noR    = count($data['project']->requirements); //number of requirements - assume 4

        $feedbacks = $data['project']->feedbacks;

        foreach ($feedbacks as $feedback) {
            $weights[$feedback->stakeholder_id][] = $feedback->weight;
        }

        $weights = array_values($weights);

        $sumArray = [];
        $rowSum=[];

        // currently, this code is only work if all the stakeholder submit
        // their feedback for all the requirements of a specific project

        for ($row = 0; $row < $noS; $row++)  //row=number of stakeholder
        {
            $tempSum=0;
            echo "</br>";
            for ($col = 0; $col < $noR; $col++) //col=number of requirements
            {
                $temp=$weights[$row][$col]*3;
                $div = $temp/4;
                //$temp=$temp*$temp;
                $weights[$row][$col] = $div;
                $square=$weights[$row][$col] *$weights[$row][$col] ;
                $sumArray[$row][$col]=$square;
                //echo $sumArray[$row][$col];

                $tempSum += $square;

                echo " ";
                //echo "tempsum = ".$tempSum;
            }

            $rowsum[$row]=$tempSum;
            for($k = 0; $k< $noR ; $k++){          //k=number of requirements
                //echo " ".$sumArray[$row][$k];
                $tempVal=$sumArray[$row][$k] / $rowsum[$row];
                $sumArray[$row][$k] = $tempVal;

                $number=$sumArray[$row][$k];
                $precision = 3;

                //echo " ";
                //echo substr(number_format($number, $precision+1, '.', ''), 0, -1);
            }
        }

        for($i=0; $i< $noR; $i++){          //i=number of requirements
            $Sum = 0;
            for($j=0; $j< $noS; $j++){      //j=number of stakeholders
                $Sum += $sumArray[$j][$i];
            }
            $sumArry[$i] = $Sum;
            //echo $sumArry[$i]." ";
            $final[$i]=$sumArry[$i];
            //echo $final[$i];
            sort($final);
        }

        $data['noR']        = $noR;
        $data['final']      = $final;
        $data['precision']  = $precision;

        return view('backend.requirements.reprotizer', $data);
    }

    public function erpimpl($projectId){
         $data = [
            'requirements' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['requirements'] = $data['project']->requirements;
        
        return view('backend.requirements.erpimpl', $data);
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
     * @param  \laravel 5 boilerplate\Models\Requirement  $requirement
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

            $requirement->delete();
//
      return redirect()->route('admin.projects.requirements.destroy', $project->id)->with('flash_message', 'requirement successfully deleted!'); //return to show all req
    //Redirect::to('/admin/projects')->with('message', 'successfully added!');
    }
}
