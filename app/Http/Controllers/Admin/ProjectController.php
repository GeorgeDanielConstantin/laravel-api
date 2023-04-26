<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        if($request->has('term')){
            $term = $request->get('term');
            $projects = Project::where('title', 'LIKE', "%$term%")->paginate(10)->withQueryString();
        } else {
            $projects = Project::paginate(10);
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::orderBy('label')->get();
        $technologies = Technology::orderBy('label')->get();
        return view('admin.projects.form', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());

        if (Arr::exists($data, 'image')) {
            $path = Storage::put('uploads/projects', $data['image']);
            $data['image'] = $path;
        }


        $project = new Project;
        $project->fill($data);
        $project->save();

        return to_route("admin.projects.show", $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('label')->get();
        $technologies = Technology::orderBy('label')->get();
        return view('admin.projects.form', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all(), $project->id);

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $path = Storage::put('uploads/projects', $data['image']);
            $data['image'] = $path;
        }

        $project->update($data);
        return to_route("admin.projects.show", $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return to_route('admin.projects.index');
    }

    //VALIDATOR
    private function validation($data, $id = null){

        $validator= Validator::make(
                $data,
            [
            'title' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'text' => 'nullable|string',
            'type_id' => 'nullable|exists:types,id',
            'technology_id' => 'nullable|exists:technologies,id',

            ],
            [

            'title.max' => 'Titolo max 50 caratteri',

            'image.string' => 'Necessaria immagine',

            'image.mimes' => 'Formati jpg , png e jpeg',

            'text.string' => 'Necessaria stringa',

            'type_id.exists' => 'Id categoria non esiste',

            'technology_id.exists' => 'Id tecnologia non esiste',

            ]
        )->validate();

        return $validator;

    }
}
