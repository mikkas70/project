<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $medias = Media::all();

		return view('editor.mediaSection' , compact('medias'));
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$media = Media::findOrFail($id);

        return view('editor.mediaReview' , compact('media'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $media = Media::findOrFail($id);

        return view('editor.editMedia', compact('media'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $media = Media::findOrFail($id);

        $rules = [
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:10|max:400',
        ];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('media.edit', $id)->withErrors($validator)->withInput();
        }

        $media->title = $request->title;
        $media->description = $request->description;
        if(!$media->save())
        {
            $message = ['message_error' => 'User edited successfully'];
            return redirect()->route('media.edit', $id)->withErrors($message)->withInput();
        }

        $message = ['message_success' => 'Media edited successfully'];
        return redirect()->route('media.index', $id)->with($message);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $media = Media::findOrFail($id);


        if(!$media->delete()){
            $message = ['message_error' => 'The media could not be deleted.'];
            return redirect()->route('media.index', $id)->withErrors($message);
        }

        $message = ['message_success' => 'The media was deleted successfully'];
        return redirect()->route('media.index', $id)->with($message);
	}

    public function approve($id){

        $media = Media::findOrFail($id);

        $media->approved_by = Auth::user()->id;


        if(!$media->save()) {
            $message = ['message_error' => 'Media could not be approved'];
            return redirect()->route('media.index' , [$media->id])->withErrors($message);
        }

        $message = ['message_success' => 'Media approved successfully'];
        return redirect()->route('media.index')->with($message);
    }

    public function refuse(Request $request, $id){


        $media = Media::findOrFail($id);


        $rules = ['refusal_msg' => 'required|min:1|max:300'];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('media.show', $id)->withErrors($validator)->withInput();
        }

        $media->refusal_msg = $request->refusal_msg;

        if(!$media->save()){
            $message = ['message_error' => 'The media could not be refused.'];
            return redirect()->route('media.show', $id)->withErrors($message)->withInput();
        }

        $message = ['message_success' => 'The media was refused successfully'];
        return redirect()->route('media.index', $id)->with($message);
    }
}
