<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use App\Project;
use App\ProjectTag;
use App\User;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller {

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
        $projects = Project::where('created_by', '=', Auth::user()->id)->get();
        $comments = Comment::where('user_id', '=', Auth::user()->id)->get();
        $medias = Media::where('created_by', '=', Auth::user()->id)->get();
        $users = User::all();

        return view('author.authorPanel', compact('projects', 'comments', 'medias', 'users'));
    }

    public function show()
    {
        $tags = ProjectTag::all();
        //$users = User::all();
        return view('author.authorPanel', compact('tags'));
    }
}
