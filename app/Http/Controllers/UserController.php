<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Institution;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

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
        $institutions = Institution::all();
        return view('auth.register', array('institutions' => $institutions));
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


	public function store(Request $request)
	{
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'institution' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'position' => 'required|min:4',
        ];

        if(strlen($request->alternativeEmail) > 0){
            $rules['alternativeEmail'] = 'required|email';
        }

        if(strlen($request->url) > 0 ){
            $rules['profileURL'] = 'required|url';
        }

        if($request->photo_url != null){
            $rules['photo_url'] = 'required';
        }

        $validator = Validator::make($request->all() , $rules);

        if($validator->fails()){
            return redirect()->route('users.index')->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name =  $request->get('name');
        $user->email =  $request->get('email');
        $alternativeEmail = $request->get('alternativeEmail');

        if($alternativeEmail){
            $user->alt_email = $alternativeEmail;
        }

        $user->password =  bcrypt($request->get('password'));


        $user->institution_id = $request->get('institution');

        $position = $request->get('position');
        if($position){
            $user->position = $position;
        }

        $photo_url = $request->get('photo_url');
        if($photo_url){
            $user->photo_url = $photo_url;
        }

        $url = $request->get('profileURL');
        if($url){
            $user->profile_url = $url;
        }
        $user->role = 1;
        $user->flags = 1;

        $message = ['message_success' => 'User was created successfully'];

        if(!$user->save()){
            $message = ['message_error' => 'Failed to create project'];
        }

        return redirect()->route('admin.index')->with($message);
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
        $institutions = Institution::all();
        $user = User::findOrFail($id);

        return view('users.edit', $user->toArray(), compact('institutions'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $user = User::findOrFail($id);

        // serve para não dar erro caso o administrador não queira mudar o email
        if($user->email == $request->email){
            $rules['email'] = 'required|email';
        }else{
            $rules['email'] = 'required|email|unique:users';
        }
        $rules = [
            'name' => 'required',
            'institution' => 'required',
            'position' => 'required|min:4',
            'role' => 'required',
        ];

                if(strlen($request->alternativeEmail) > 0){
                    $rules['alternativeEmail'] = 'required|email';
                }

                if(strlen($request->password) > 0){
                    $rules['password'] = 'required|min:6';
                    $rules['password_confirmation'] = 'required|min:6| same:password';
                }

                if(strlen($request->url) > 0 ){
                    $rules['profileURL'] = 'required|url';
                }

            $validator = Validator::make($request->all() , $rules);

            if($validator->fails()){
                return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
            }
                    $user->name = $request->get('name');
                    $user->email = $request->get('email');

                    $alt_email = $request->get('alternativeEmail');
                    if($alt_email){
                        $user->alt_email = $alt_email;
                    }

                    $password = $request->get('password');
                    if($password){
                        $user->password = bcrypt($password);
                    }
                    $user->institution_id = $request->get('institution');
                    $user->position = $request->get('position');
                    $profile_url = $request->get('profile_url');
                    if($profile_url){
                        $user->profile_url = $profile_url;
                    }
                    $user->role = $request->get('role');


                    $message = ['message_success' => 'User edited successfully'];

                    if(!$user->save()){
                        $message = ['message_error' => 'Failed to edit user'];
                    }

                    return redirect()->route('admin.index')->with($message);

    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = User::findOrFail($id);

        foreach(Project::all() as $project){
            if($project->created_by == $user->id){
                $message = ['message_error' => 'This user has projects and cannot be removed'];
                return redirect()->route('admin.index')->with($message);
            }
        }

        $message = ['message_success' => 'User removed successfully'];
        if(!$user->delete()){
            $message = ['message_error' => 'Failed to remove user'];
        }

        return redirect()->route('admin.index')->with($message);
	}


    public function changeFlag($id){
        $user = User::findOrFail($id);


        if($user->flags == 0){
            $user->flags = 1;
            $temp = "enabled.";


        }else{
            $user->flags = 0;
            $temp = "disabled.";
        }

        if(!$user->save()){
            $message = ['message_error' => 'Failed to change user account status'];
            return redirect()->route('admin.index')->with($message);
        }
        $message = ['message_success' => 'User '.$user->name.' account is now '.$temp];
        return redirect()->route('admin.index')->with($message);
    }

}
