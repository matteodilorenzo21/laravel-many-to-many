<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $technologies = Technology::select('id', 'label')->get();
        $categories = Category::select('id', 'label')->get();
        return view('admin.projects.create', compact('project', 'categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,mp4|max:5120',
            'url' => 'nullable|url',
            'slug' => 'string|unique:projects,slug',
            'completion_year' => 'nullable|integer',
            'client' => 'nullable|string',
            'project_duration' => 'nullable|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,label',
        ]);

        $project = new Project();

        $project->fill($validatedData);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();

            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
            $project->image = $originalFileName;
        }

        if (!$project->slug) {
            $project->slug = Str::slug($project->title, '-');
        }

        $project->save();

        if (isset($validatedData['technologies'])) {
            $technologyLabels = $validatedData['technologies'];

            $technologyIds = Technology::whereIn('label', $technologyLabels)->pluck('id')->toArray();

            $project->technologies()->attach($technologyIds);
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::select('id', 'label')->get();
        $technologies = Technology::select('id', 'label')->get();
        $project_technology_ids = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies', 'project_technology_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,mp4|max:5120',
            'url' => 'nullable|url',
            'slug' => 'string|unique:projects,slug,' . $project->id,
            'completion_year' => 'nullable|integer',
            'client' => 'nullable|string',
            'project_duration' => 'nullable|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,label',
        ]);

        $data = $request->all();

        // Verifica se è stato caricato un nuovo file immagine
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();

            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
            $data['image'] = $originalFileName;
        }

        $project->update($data);

        // Aggiungi le tecnologie selezionate
        if (isset($data['technologies'])) {
            $technologyLabels = $data['technologies'];

            $technologyIds = Technology::whereIn('label', $technologyLabels)->pluck('id')->toArray();

            $project->technologies()->sync($technologyIds);
        }

        return redirect()->route('admin.projects.show', $project->id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
