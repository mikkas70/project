<?php namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
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

    public function createComment(Request $request, $id){

        Project::findOrFail($id);

        $rules = ['comment' => 'required|min:1|max:300'];


        if(!Auth::check()){
            $rules['user_name'] = 'required|min:3';
        }

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('projects.show', $id)->withErrors($validator)->withInput();
        }

        $comment = new Comment;
        $comment->comment = $request->get('comment');
        $comment->project_id = $id;

        if(!Auth::check()){
            $comment->user_name = $request->get('user_name');
        }else{
            $comment->user_id = Auth::user()->id;
            if(Auth::user()->role >= 2)
                $comment->approved_by = Auth::user()->id;
        }



        if(!$comment->save()){
            $message = ['message_error' => 'Failed to create comment'];
            return redirect()->route('projects.show' , [$id])->withErrors($message)->withInput();

        }

        $message = ['message_success' => 'Success! The comment was submitted for approval.'];
        return redirect()->route('projects.show' , [$id])->with($message);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

    }

    public function sendRequest(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $user = User::findOrFail($project->created_by);

        $rules = ['message' => 'required|min:1|max:300'];


        if(!Auth::check()){
            $rules['name'] = 'required|min:3';
        }

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('projects.show', $id)->withErrors($validator)->withInput();
        }


        Mail::raw($request->message,function($message) use ($request, $user)
        {
            $message->subject('Contact request from '.$request->name);
            $message->to($user->email);
        });

        if($user->alt_email != null){
            Mail::raw($request->message,function($message) use ($request, $user)
            {
                $message->subject('Contact request from '.$request->name);
                $message->to($user->alt_email);
            });
        }

        $message = ['message_success' => 'The contact request was sent successfully.'];
        return redirect()->route('projects.show', $id)->with($message);
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
	public function update($id)
	{
		//
	}

    public function refuse(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $rules = ['refusal_msg' => 'required|min:1|max:300'];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('editor.rejectComment', $id)->withErrors($validator)->withInput();
        }

        $comment->refusal_msg = $request->refusal_msg;

        if(!$comment->save()){
            $message = ['message_error' => 'The comment could not be refused.'];
            return redirect()->route('editor.rejectComment', $id)->withErrors($message)->withInput();
        }

        $message = ['message_success' => 'The comment was refused successfully'];
        return redirect()->route('editor.index', $id)->with($message);
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
