<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;
use App\Tag;
use App\ProjectTag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProjectTagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $project_tags = ProjectTag::all();

        foreach ($project_tags as $project_tag) {
            $tags[$project_tag->id] = Tag::find($project_tag->tag_id)->tag;
            $projects[$project_tag->id] = Project::find($project_tag->project_id)->name;
        }

        return view('editor.projectTagsSection', compact('project_tags', 'tags', 'projects'));
    }

    public function tagsPanel()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    public function add($id)
    {
        $project = Project::findOrFail($id);
        $tags = Tag::all();
        $ptags = Project::find(1)->project_tags()->where('project_id', '=', $id)->get();

        $num = 0;
        foreach ($ptags as $ptag) {
            if ($ptag->project_id == $project->id) {
                $project_tags[$num] = $ptag->tag_id;
                $num++;
            }
        }

        return view('project_tag.add', compact('project', 'tags', 'project_tags', 'ptags'));
    }

    public function addToProject($tag_id, $proj_id)
    {
        $project_tag = new ProjectTag();
        $project_tag->project_id = $proj_id;
        $project_tag->tag_id = $tag_id;
        $project_tag->added_by = Auth::user()->id;

        if (Auth::user()->role >= 2) {
            $project_tag->state = 1;
            $project_tag->approved_by = Auth::user()->id;
            $message = ['message_success' => 'Tag was added successfully'];
        } else {
            $project_tag->state = 0;
            $project_tag->approved_by = null;
            $message = ['message_success' => 'Tag was successfully sent for approval'];
        }

        if (!$project_tag->save()) {
            $message = ['message_error' => 'Failed to add tag to project'];
            return redirect()->route('tag.add', $proj_id)->with($message);
        }

        return redirect()->route('project_tag.add', $proj_id)->with($message);
    }

    public function removeFromProject($tag_id, $proj_id)
    {
        $proj_tags = ProjectTag::all();

        foreach ($proj_tags as $proj_tag) {
            if ($proj_tag->tag_id == $tag_id && $proj_tag->project_id == $proj_id) {
                if (!$proj_tag->delete()) {
                    $message = ['message_error' => 'The project tag could not be deleted.'];
                    return redirect()->route('tag.add', $proj_id)->with($message);
                }
            }
        }
        $message = ['message_success' => 'The tag was removed from project successfully'];

        return redirect()->route('project_tag.add', $proj_id)->with($message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function refuse(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}