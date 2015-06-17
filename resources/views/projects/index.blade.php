@extends('app')
@section('content')


<div class="container">
<div class="page-header">
    <h1>Projects</h1>
</div>
@if(Session::has('message_error'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		 <button type="button" class="close" data-dismiss="alert" arialabel="Close"><span
			aria-hidden="true">&times;</span></button>
			 {{Session::get('message_error')}}
		</div>
@elseif(Session::has('message_success'))

<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message_success')}}
</div>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <form class="form-horizontal" role="form" method="get" action="{{route('projects.index')}}">
                <table class="table table-condensed">
                    <tr>
                        <th style="vertical-align: middle">
                            Search:
                        </th>
                        <th>
                            <input type="text" class="form-control" name="search" value="">
                        </th>
                        <th style="vertical-align: middle">
                            Sort by:
                        </th>
                        <th>
                            <select class="form-control" name="sort_by" >
                                <option value="name" >Name</option>
                                <option value="theme" >Theme</option>
                            </select>
                        </th>
                        <th style="vertical-align: middle">
                            Sort type:
                        </th>
                        <th>
                            <select class="form-control" name="sort_type">
                                <option value="asc" selected >Ascendant</option>
                                <option value="desc" >Descendant</option>
                            </select>
                        </th>
                        <th style="vertical-align: middle">
                            Results per page:
                        </th>
                        <th>
                            <select class="form-control" name="results">
                                <option value="5" >5</option>
                                <option value=" selected" >10</option>
                                <option value="20" >20</option>
                                <option value="50">50</option>
                            </select>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@if(count($projects))
            <div class="panel panel-default">

                <div class="panel-heading">

    <table class="table table-striped">

    <thead>
        <tr>
            <th>Project Name</th>
            <th>Theme</th>
            <th>Author</th>
            <th colspan="2" class="col-xs-1">Actions</th>
        </tr>

    </thead>

    <tbody>

    	@foreach($projects as $project)
            <tr>
            <td>{{ $project->name}}</td>
                <td>{{ $project->theme}}</td>
            <td>
                @foreach($users as $user)
                    @if($user->id == $project->created_by)
                        {{$user->name}}
                    @endif
                @endforeach
            </td>

            <td>
                <a class="btn btn-primary" href="{{route('projects.show' , [$project->id])}}" role="button">Visit Project</a>
            </td>

            @if(Auth::check() && Auth::user()->role >= 2 )
                <td>
                    <a class="btn btn-primary" href="{{route('projects.edit' , [$project->id])}}" role="button">Edit</a>
                </td>
                @if($project->approved_by == null && $project->refusal_msg == null)
                <td>
                    <a class="btn btn-primary" href="{{route('projects.review' , [$project->id])}}" role="button">Review</a>
                </td>
                @endif
                <td>
                    <form action="{{route('projects.destroy' , [$project->id])}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                    <!--<a class="btn btn-danger" href="{{route('projects.delete' , [$project->id])}}" role="button">Delete</a> -->
                </td>
            @endif
        </tr>
        @endforeach
        
    </tbody>

</table>
                </div>
            </div>
@else
	<p class="well">There are no projects added yet.</p>
@endif
</div>
@endsection()