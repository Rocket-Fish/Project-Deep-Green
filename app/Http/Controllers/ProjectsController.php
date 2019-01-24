<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

/*
* This controller is for Project input and output
*/


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Project::create([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => $request->input('title'),
            'img_url' => $request->input('img_url'),
            'description' => $request->input('description'),
            'link_to' => $request->input('link_to'),
            'link_desc' => $request->input('link_desc')
        ]);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // update params
        $project->update_at = Carbon::now();
        $project->title = $request->input('title');
        $project->img_url = $request->input('img_url');
        $project->description = $request->input('description');
        $project->link_to = $request->input('link_to');
        $project->link_desc = $request->input('link_desc');
        // save the new params
        $project->save();
        // returns back to previous page
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return $this->index();
    }
}
