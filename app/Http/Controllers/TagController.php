<?php namespace App\Http\Controllers;

use App\ProjectTag;
use App\Tag;
use App\Http\Requests;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function add($id)
    {
        $project = Project::findOrFail($id);

        return view('tag.add', compact('project'));
    }

    public function createTag(Request $request, $id)
    {
        $rules = [
            'tag' => 'required|unique:tags|max:255',
        ];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('tag.add', $id)->withErrors($validator)->withInput();
        }

        $tag = new Tag;
        $tag->tag = $request->tag;

        $message = ['message_success' => 'Tag was created successfully and sent for approval'];

        if(!$tag->save()){
            $message = ['message_error' => 'Failed to create tag'];
            return redirect()->route('tag.add', $id)->withErrors($validator)->withInput();
        }

        $project_tag = new ProjectTag();
        $project_tag->project_id = $id;
        $project_tag->tag_id = $tag->id;
        $project_tag->added_by = Auth::user()->id;

        if(Auth::user()->role >= 2){
            $project_tag->state = 1;
            $project_tag->approved_by = Auth::user()->id;
        }else{
            $project_tag->state = 0;
            $project_tag->approved_by = null;
        }



        if(!$project_tag->save()){
            $message = ['message_error' => 'Failed to submit project tag for approval'];
            return redirect()->route('tag.add', $id)->withErrors($validator)->withInput();
        }

        return redirect()->route('project_tag.add', $id)->with($message);
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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
