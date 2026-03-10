<?php
class ProjectController extends Controller
{
    public function index()
    {
        $projects = \App\Models\Project::active()->get();
        return view('projects.index', compact('projects'));
    }

    public function show(string $slug)
    {
        $project  = \App\Models\Project::where('slug', $slug)->firstOrFail();
        $related  = \App\Models\Project::active()->where('id','!=',$project->id)->limit(3)->get();
        return view('projects.show', compact('project','related'));
    }
}
