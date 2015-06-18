<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Media;
use App\Project;
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

        if(Auth::user()->role >= 2)
        {
            return view('editor.mediaSection' , compact('medias'));
        }

        return redirect()->route('author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

    }

    public function createMedia(Request $request, $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:600',
            'alt' => 'required|max:255',
        ];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('media.submit', $id)->withErrors($validator)->withInput();
        }

        $media = new Media;
        $media->project_id = $id;
        $media->title =  $request->get('title');
        $media->description =  $request->get('description');
        $media->alt =  $request->get('alt');
        $media->int_file =  "projects/".$request->get('filename');
        $media->public_name =  "projects/".$request->get('filename');
        $media->ext_url = $request->get('ext_url');


        $type = strrchr($request->filename, ".");
        if($type == ".jpg"){
            $media->mime_type = "image/jpg";
        }elseif($type == ".png"){
            $media->mime_type = "image/png";
        }elseif($type == ".pdf"){
            $media->mime_type = "document/pdf";
        }elseif($media->url != null){
            $media->mime_type = "video/url";
        }

        $media->created_by = Auth::user()->id;
        $media->state = 1;
        $media->flags = 0;
        $media->approved_by = null;

        $message = ['message_success' => 'Media was successfully sent for approval'];

        if(!$media->save()){
            $message = ['message_error' => 'Failed to create media'];
            return redirect()->route('media.submit', $id)->withErrors($validator)->withInput();
        }

        return redirect()->route('projects.show', $id)->with($message);

    }

    public function submit($id)
    {
        $project = Media::findOrFail($id);


        return view('media.submit', compact('project'));
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

        // array para poder receber os campos do outro lado
        return view('media.edit', compact('media'));
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
            'title' => 'required|max:255',
            'description' => 'required|max:600',
            'alt' => 'required|max:255',
        ];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('media.edit', $id)->withErrors($validator)->withInput();
        }

        $media->title = $request->title;
        $media->description = $request->description;
        $media->title =  $request->title;
        $media->description =  $request->description;
        $media->alt =  $request->alt;
        $media->int_file =  "projects/".$request->filename;
        $media->public_name =  "projects/".$request->filename;
        $media->ext_url = $request->ext_url;

        $type = strrchr($request->filename, ".");
        if($type == ".jpg"){
            $media->mime_type = "image/jpg";
        }elseif($type == ".png"){
            $media->mime_type = "image/png";
        }elseif($type == ".pdf"){
            $media->mime_type = "document/pdf";
        }elseif($media->url != null){
            $media->mime_type = "video/url";
        }

        $media->state = 1;
        $media->flags = 0;

        if(Auth::user()->role < 2 && Auth::user()->id == $media->created_by)
        {
            $media->approved_by = null;
            $media->refusal_msg = null;
        }else{
            $media->approved_by = Auth::user()->id;
            $media->refusal_msg = null;
        }



        if(!$media->save())
        {
            $message = ['message_error' => 'Failed to update media!'];
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
