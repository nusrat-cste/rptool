<?php

namespace App\Http\Controllers\Backend;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;



class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['projects'] = Project::all();

        return view('backend.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.projects.create');    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $project = new Project();
        $project->fill($data);
        $project->save();

        return redirect()->route('admin.projects.index')->with('flash_success', 'New Project added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['project'] = Project::find($id);

        if( ! $data['project'] instanceof Project) {
            return 'Nothing found!';
        }
        
        //return $project->project_name;
        return view('backend.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['project'] = Project::find($id);

        if( ! $data['project'] instanceof Project) {
            return 'Nothing found!';
        }

        //return $project->project_name;
        return view('backend.projects.edit', $data);

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
        $project = Project::find($id);

        $this->validate($request, [
        'project_name' => 'required',
        'additional_info' => 'required'
    ]);

    $input = $request->all();

    $project->fill($input)->save();

    Session::flash('flash_message', 'Project successfully Updated!');

    return redirect('/admin/projects');
    //Redirect::to('/admin/projects')->with('message', 'successfully added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $project = Project::findOrFail($id);

            $project->delete();

      Session::flash('flash_message', 'Task successfully deleted!');

    return redirect('/admin/projects');}
}
