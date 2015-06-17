<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Project;
use App\ProjectTag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EditorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
        $comments = Comment::all();
        $users = User::all();
        return view('editor.editorPanel', compact('comments', 'users'));
    }

    public function show()
    {

        //$tags = ProjectTag::all();
        //$users = User::all();
        return view('editor.editorPanel', compact('tags'));
    }

    public function tagsPanel()
    {
       /* $tags = ProjectTag::all();
        return view('editor.tagsPanel' , compact('tags'));*/
    }

    public function projectsPanel()
    {
        $projects = Project::all();
        $users = User::all();
        return view('editor.projectSection' , compact('projects', 'users'));
    }



    public function approveContent($id)
    {

        $comment = Comment::findOrFail($id);

        $comment->approved_by = Auth::user()->id;

        if(!$comment->save()){
            $message = ['message_error' => 'Failed to approve comment'];
            return view('editor.editorPanel', compact('comments', 'users'))->withErrors($message);
        }

        $message = ['message_success' => 'Comment Approved.'];
        return redirect()->route('editor.index')->with($message);
    }


    public function rejectComment($id){
        $comment = Comment::findOrFail($id);
        $project = Project::findOrFail($comment->project_id);
        $user = User::findOrFail($comment->user_id);

        return view('editor.rejectComment' , compact('comment','user', 'project'));
    }


}
