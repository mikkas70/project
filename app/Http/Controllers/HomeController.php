<?php namespace App\Http\Controllers;

use App\Media;
use App\Project;
use Carbon\Carbon;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $date = getdate();
        $actual_date = $date['year'].'-'.$date['month'].'-'.$date['mday'];
        $projects_updated = Project::orderBy('updated_at', 'desc')->take(4)->get();
        $projects = Project::where('featured_until', '>', $actual_date)->get();
        $projects_featured_images = Project::where('featured_until', '>', $actual_date)->take(4)->get();


        foreach($projects as $project)
        {
            $projects_image[$project->id] = Media::where('project_id', '=', $project->id)->get()->first();
        }

        foreach($projects_updated as $project)
        {
            $projects_updated_image[$project->id] =  Media::where('project_id', '=', $project->id)->get()->first();
        }

        return view('home', compact('projects', 'projects_updated', 'projects_image', 'projects_updated_image', 'projects_featured_images'));

    }

}
