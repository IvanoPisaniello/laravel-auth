<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view("admin.projects.index", compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'github_url' => 'required',
            'languages_used' => 'required',
            'description' => 'required',
        ]);

        $counter = 0;

        do {
            // creo uno slug e se il counte e maggiore di 0, concateno il counter
            $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste gia un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // ripeto il ciclo finche esiste gia un elemento con questo slug aggiungendo -$counter

        $data["slug"] = Str::slug($data["title"]);
        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project = Project::create($data);

        return redirect()->route('admin.projects.show', $project->slug);
    }
}