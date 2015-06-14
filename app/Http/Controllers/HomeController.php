<?php namespace App\Http\Controllers;

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

        $projects = Project::where('featured_until', '>', $actual_date)->get();

        $projects_updated = Project::orderBy('updated_at', 'desc')->take(4)->get();
        return view('home', compact('projects'), compact('projects_updated'));
    }

}
