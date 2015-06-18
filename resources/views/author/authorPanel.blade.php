@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>Author Panel</h1>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>My Submitted Content</h3>

                    </div>
                    <div class="panel-body">
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
                        @if(count($projects) || count($comments) || count($media))
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th colspan="2" class="col-xs-1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    @if($project->approved_by != null)
                                        <tr style="background-color: rgba(0, 255, 0, 0.30)">
                                            @elseif($project->refusal_msg != null)
                                        <tr style="background-color: rgba(255, 0, 0, 0.30)">
                                    @else
                                        <tr>
                                            @endif
                                            <td>{{ $project->name}}</td>
                                            <td>
                                                Project
                                            </td>
                                            <td>
                                                @if($project->approved_by != null)
                                                    Approved
                                                @elseif($project->refusal_msg != null)
                                                    Refused: {{$project->refusal_msg}}
                                                @else
                                                    Waiting for Approval
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{route('projects.edit' , [$project->id])}}" role="button">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{route('projects.destroy' , [$project->id])}}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @foreach($comments as $comment)
                                            @if($comment->approved_by != null)
                                                <tr style="background-color: rgba(0, 255, 0, 0.30)">
                                                    @elseif($comment->refusal_msg != null)
                                                <tr style="background-color: rgba(255, 0, 0, 0.30)">
                                            @else
                                                <tr>
                                                    @endif
                                                    <td>{{ $comment->comment}}</td>
                                                    <td>
                                                        Comment
                                                    </td>
                                                    <td>
                                                        @if($comment->approved_by != null)
                                                            Approved
                                                        @elseif($comment->refusal_msg != null)
                                                            Refused: {{$comment->refusal_msg}}
                                                        @else
                                                            Waiting for Approval
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{route('comments.edit' , [$comment->id])}}" role="button">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{route('comments.destroy' , [$comment->id])}}" method="post">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @foreach($medias as $media)
                                                    @if($media->approved_by != null)
                                                        <tr style="background-color: rgba(0, 255, 0, 0.30)">
                                                            @elseif($media->refusal_msg != null)
                                                        <tr style="background-color: rgba(255, 0, 0, 0.30)">
                                                    @else
                                                        <tr>
                                                            @endif
                                                            <td>{{ $media->title}}</td>
                                                            <td>
                                                                Media
                                                            </td>
                                                            <td>
                                                                @if($media->approved_by != null)
                                                                    Approved
                                                                @elseif($media->refusal_msg != null)
                                                                    Refused: {{$media->refusal_msg}}
                                                                @else
                                                                    Waiting for Approval
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary" href="{{route('media.edit' , [$media->id])}}" role="button">Edit</a>
                                                            </td>
                                                            <td>
                                                                <form action="{{route('media.destroy' , [$media->id])}}" method="post">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="_method" value="DELETE" />
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
                            <p class="well">You have not submitted any content yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection