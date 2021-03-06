<?php

namespace App\Http\Controllers\Backend;

use App\Models\Access\User\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StakeholdersController extends Controller
{
    /**
     * @var Project
     */
    private $project;
    /**
     * @var User
     */
    private $stakeholder;
    /**
     * @var User
     */
    private $projects_stakeholder;
    /**
     * RequirementsController constructor.
     * @param Project $project
     * @param User $stakeholder
    * @param User $projects_stakeholder
     * @internal param Requirement $requirement
     */
    public function __construct(Project $project, User $stakeholder, User $projects_stakeholder)
    {
        $this->project = $project;
        $this->stakeholder = $stakeholder;
        $this->projects_stakeholder = $projects_stakeholder;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $projectId
     * @param  int  $id

     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $data = [
            'stakeholders' => [],
        ];

        $data = [
            'projects_stakeholder' => [],
        ];

        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['stakeholders'] = $data['project']->stakeholders;


        return view('backend.stakeholders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $projectId

     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $data['project'] = $this->project->find($projectId);

        if( ! $data['project'] instanceof $this->project) {
            abort(404);
        }

        $data['stakeholders'] = $this->stakeholder->whereHas('roles', function ($query) {
                $query->whereDoesntHave('permissions', function ($q) {
                    $q->where('permissions.name', 'view-backend');
                })
                ->where('roles.name', '!=', 'Administrator');
            })->whereDoesntHave('projects', function ($q) use($projectId) {
                $q->where('projects_stakeholders.project_id', $projectId);
        })->get();

        if(count($data['stakeholders']) < 1) {

            return redirect()->back()->with('flash_warning', 'All stakeholders are added already!');
        }

        return view('backend.stakeholders.create', $data);
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
        $project = $this->project->find($projectId);

        if( ! $project instanceof $this->project) {
            abort(404);
        }

        $input = $request->except('_token');

        $project->stakeholders()->syncWithoutDetaching($input['stakeholders']);


        return redirect()->route('admin.projects.stakeholders.index', $project->id)->with('flash_success', 'New Stakeholders added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $id)
    {
        //
        $data['stakeholder'] = $this->stakeholder->find($id);

        $data['project'] = $this->project->find($projectId);

        //return view('backend.stakeholders.edit', $data);

        return 1;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId,$id)
    {
        //
        $project = $this->project->findOrFail($projectId);

        // Detach a single stakeholder from the project...
        $project->stakeholders()->detach($id);

        return redirect()->back()
                        ->with('flash_info', 'stakeholder successfully removed from this project!');

    }
}
