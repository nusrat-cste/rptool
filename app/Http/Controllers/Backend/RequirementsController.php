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
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        //
    }
}
