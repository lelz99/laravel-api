<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $project = new Project();
        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id', 'icon', 'color')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();

        $project->fill($data);
        
        $project->slug = Str::slug($project->title);
        $project->is_published = Arr::exists($data, 'is_published');

        if(Arr::exists($data, 'preview_project')){
           $img_url = Storage::putfile('project_images', $data['preview_project']);
           $project->preview_project = $img_url;
        };

        $project->save();

        if(Arr::exists($data, 'technologies')) $project->technologies()->attach($data['technologies']);

        return to_route('admin.projects.show', $project);
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $technologies = Technology::select('label', 'id', 'color', 'icon')->get();
        $prev_technologies = $project->technologies->pluck('id')->toArray();

        $types = Type::select('label', 'id')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'prev_technologies'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->fill($data);

        $project->slug = Str::slug($project->title);
        $project->is_published = Arr::exists($data, 'is_published');

        if(Arr::exists($data, 'preview_project')){
            if($project->preview_project) Storage::delete($project->preview_project);

            $img_url = Storage::putfile('project_images', $data['preview_project']);
            $project->preview_project = $img_url;
        };

        $project->save();

        if(Arr::exists($data, 'technologies')) $project->technologies()->sync($data['technologies']);
        elseif(!Arr::exists($data, 'technologies') && $project->has('technologies')) $project->technologies()->detach();
        

        return to_route('admin.projects.show', $project)->with('message', "{$project->title} modificato con successo");
    }

    public function destroy(Project $project)
    {
        if($project->preview_project) Storage::delete($project->preview_project); // spostare successivamente in drop

        $project->delete();

        if($project->has('technologies')) $project->technologies()->detach();

        return to_route('admin.projects.index')->with('message', "{$project->title} eliminato con successo");
    }
}
