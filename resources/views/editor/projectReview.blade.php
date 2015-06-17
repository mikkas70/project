@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reviewing project <strong>{{ $project->name }}</strong></div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('projects.update' , [$project->id])}}">
                            <input type="hidden" name="_method" value="PUT">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <label type="text" class="form-control"> {{ $project->name}} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Acronym</label>
                                <div class="col-md-6">
                                    <label type="text" class="form-control"> {{ $project->acronym}} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type</label>
                                <div class="col-md-6">
                                    <label type="text" class="form-control"> {{ $project->type}} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Theme</label>
                                <div class="col-md-6">
                                    <label type="text" class="form-control"> {{ $project->theme}} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Keywords</label>
                                <div class="col-md-6">
                                    <label type="text" class="form-control"> {{ $project->keywords}} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Used Software</label>
                                <div class="col-md-6">
                                    @if($project->used_software)
                                        <label type="text" class="form-control"> {{ $project->used_software}} </label>
                                    @endif
                                        <label type="text" class="form-control"> (Not defined) </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Used Hardware</label>
                                <div class="col-md-6">
                                    @if($project->used_hardware)
                                        <label type="text" class="form-control"> {{ $project->used_hardware}} </label>
                                    @endif
                                    <label type="text" class="form-control"> (Not defined) </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Observations</label>
                                <div class="col-md-6">
                                    @if($project->used_hardware)
                                        <label type="text" class="form-control"> {{ $project->observations}} </label>
                                    @endif
                                    <label type="text" class="form-control"> (Not defined) </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea name="description" cols="60" rows="10" readonly>{{$project->description}}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ route('projects.approve', [$project->id]) }}" class="btn btn-success" style="color:white; margin-left: 10px">Approve</a>
                                        <a href="{{ route('editor.tagsPanel') }}" class="btn btn-danger" style="color:white; margin-left: 10px">Reject</a>

                                        <a class="btn" href="{{route('editor.projectsPanel')}}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')