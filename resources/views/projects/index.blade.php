@if(Auth::check() && Auth::user()->role >= 2 )
        @extends('editor')
        @section('editor_content')
@else
    @section('content')
@endif


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

@if(count($projects))
            <div class="panel panel-default">
                <div class="panel-heading">
<table class="table table-striped">

    <thead>
        <tr>
            <th>Project Name</th>
            <th>Author</th>
            <th colspan="2" class="col-xs-1">Actions</th>
        </tr>

    </thead>

    <tbody>

    	@foreach($projects as $project)
        <tr>
            <td>{{ $project->name}}</td>
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