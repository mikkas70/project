<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
	public function index()
	{
		//Ir buscar todos os projectos
		$projects = Project::all();
        $users = User::all();

		return view('projects.index', compact('projects'), compact('users'));
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
        //TODO falta mandar comments
		// mostrar pagina de um projecto

        return view('projects.singleProject', compact('project'));
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
		return view('projects.edit', $project->toArray());
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
          'title', 'required|min:10',
          'description', 'required|min:20'
        ];

        // se for preenchido o homepage, tem de ser válido sendo um url
        if(strlen($request->get('homepage')) > 0 ){
            $rules['homepage'] = 'required|url';
        }

        if($request->get('title') != $project->title){
            $rules['name'] = '|unique:projects, title';
        }

        $validator = Validator::make($request->all(), $rules);

        //caso falhe, volta à mesma pagina com os certos erros
        if($validator->fails()){
            return redirect()->route('projects.edit', $id)->withErrors($validator)->withInput();
        }

        $project->title = $request->get('title');
        $project->description  = $request->get('description');
        $homepage = $request->get('homepage');

        if($homepage){
            $project->homepage = $homepage;
        }else{
            $project->homepage = null;
        }

        $message = ['message_success' => 'Project saved successfully'];

        if(!$project->save()){
            $message = ['message_error' => 'Failed to save project'];
        }


            return redirect()->route('projects.index')->with($message);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = Project::findOrFail($id);
		$message = ['message_success' => 'Project removed successfully'];
		if(!$project->delete()){
			$message = ['message_error' => 'Failed to remove project'];
		}

		return redirect()->route('projects.index')->with($message);
	}

    public function getLastUpdated()
    {
        //TODO percorrer todos projs, devolver ultimos 4
    }

}
