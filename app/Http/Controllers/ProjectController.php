<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Media;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Project;

class ProjectController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        $search = $request->get('search');
        $sortby = $request->get('sort_by', 'Name');
        $totalPerPage = $request->get('results', 10);
        $order = $request->get('sort_type', 'ASC');

        if ($search == null) {
            $projects = Project::orderBy($sortby, $order)->paginate($totalPerPage);
            $projects->appends(['search' => $search, 'sort_by' => $sortby, 'results' => $totalPerPage, 'sort_type' => $order])->render();

        }else{
            $projects = Project::where('name', 'like', '%'.$search.'%')->orderBy($sortby, $order)->paginate($totalPerPage);
            //$users = User::all();
            $projects->appends(['search' => $search, 'sort_by' => $sortby, 'results' => $totalPerPage, 'sort_type' => $order])->render();
        }

        return view('projects.index', compact('projects'), compact('users', 'medias'));
    }


    public function destroy($id){
         $project = Project::findOrFail($id);
         if(!$project->delete()){
             $message = ['message_error' => 'Failed to remove project'];
             return redirect()->route('editor.projectsPanel')->withErrors($message);
         }


        $message = ['message_success' => 'Project removed successfully'];
        return redirect()->route('editor.projectsPanel')->with($message);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'name' => null,
            'description' => null,
            'homepage' => null
        ];

        return view('projects.add', $data);
    }

    public function review($id){
        $project = Project::findOrFail($id);

        return view('editor.projectReview', compact('project'));
    }

    public function approve($id){

        $project = Project::findOrFail($id);

        $project->approved_by = Auth::user()->id;

        if(!$project->save())
        {
            $message = ['message_error' => 'Project could not be approved'];
            return redirect()->route('editor.projectReview' , [$project->id])->withErrors($message);
        }

        $message = ['message_success' => 'Project approved successfully'];

        return redirect()->route('editor.projectsPanel')->with($message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:10|unique:projects,name',
            'description' => 'required|min:20'
        ];
        if(strlen($request->get('homepage')) > 0){
            $rules['homepage'] = 'required|url';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('projects.create')->withErrors($validator)->withInput();
        }

        $project = new Project;
        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->user()->associate(Auth::user());
        $homepage = $request->get('homepage');
        if($homepage){
            $project->homepage = $homepage;
        }
        $message = ['message_success' => 'Project created successfully'];

        if(!$project->save()){
            $message = ['message_error' => 'Failed to create project'];
        }

        return redirect()->route('projects.index')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        $medias = Project::find(1)->media()->where('project_id', '=', $id)->get();
        $comments = Project::find(1)->comments()->where('project_id', '=', $id)->orderBy('created_at', 'DESC')->get();
        $users = User::all();


        // mostrar pagina de um projecto
        return view('projects.singleProject', compact('project'), compact('medias', 'comments', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        // array para poder receber os campos do outro lado
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request , $id)
    {
        $project = Project::findOrFail($id);

        $rules = [
            'name' => 'required|min:5|max:255',
            'acronym' => 'max:255',
            'description' => 'required|min:1|max:255',
            'type' => 'max:255',
            'theme' => 'max:255',
            'keywords' => 'max:255',
            'used_software' => 'max:255',
            'used_hardware' => 'max:255',
            'observations' => 'max:255',

        ];

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('projects.edit', $id)->withErrors($validator)->withInput();
        }

        $project->name = $request->name;
        $project->acronym = $request->acronym;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->theme = $request->theme;
        $project->keywords = $request->keywords;
        $project->used_software = $request->used_software;
        $project->used_hardware = $request->used_hardware;
        $project->observations = $request->observations;

        if(!$project->save())
        {
            $message = ['message_error' => 'Project could not be saved!y'];
            return redirect()->route('projects.edit', $id)->withErrors($message)->withInput();
        }

        $message = ['message_success' => 'Project edited successfully'];
        return redirect()->route('projects.show', $id)->with($message);
    }

    public function projectsPanel()
    {
        $projects = Project::all();
        $users = User::all();
        return view('editor.projectSection' , compact('projects', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */


    public function getLastUpdated()
    {
        //TODO percorrer todos projs, devolver ultimos 4
    }

}
