@extends('app')

@section('content')
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

@if(count($projects))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Homepage</th>
            <th colspan="2" class="col-xs-1">Actions</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($projects as $project)
        <tr>
            <td>{{ $project->name}}</td>
            <td>@if($project->homepage)
            <a href="{{ $project->homepage }}">{{ $project->homepage }}</a> @endif</td>
            <td>
                <a class="btn btn-primary" href="{{route('projects.edit' , [$project->id])}}" role="button">Edit</a>
            </td>
            <td>
                <form action="{{route('projects.destroy' , [$project->id])}}" method="post">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                	<input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                    Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>
@else
	<p class="well">Go ahead and add the first project.</p>
@endif
<a class="btn btn-success" href="{{route('projects.create')}}" role="button">Add New Project</a>

@endsection('content')