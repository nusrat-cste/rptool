<?php

namespace App\Http\Controllers\Backend;

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
