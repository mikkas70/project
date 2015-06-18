@extends('app')

@section('content')
    <div class="container">
        @if(count($errors))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" arialabel="Close"><span
                            aria-hidden="true">&times;</span></button>
                @foreach($errors->all() as $error)
                    {{$error}}<br>
                @endforeach
            </div>
        @elseif(Session::has('message_success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('message_success')}}
            </div>
        @endif
        <div class="page-header">
            <h1>Project Details</h1>
            @if(Auth::check() && ($project->created_by == Auth::user()->id || Auth::user()->role >= 2))
                <td>
                    <p>Actions: </p>
                    <a class="btn btn-primary" href="{{route('projects.edit' , [$project->id])}}" role="button">Edit</a>
                    <a class="btn btn-primary" href="{{route('media.submit', [$project->id])}}" role="button">Submit Media</a>
                </td>

            @endif
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">

                <table class="table table-striped">
                    <thead>

                    </thead>
                    <tbody style="width: 100px">
                    <tr>
                        <td><strong>Project Name:</strong></td>
                        <td>{{$project->name}}</td>
                    </tr>

                    <tr>
                        @foreach($users as $user)
                            @if($user->id == $project->created_by)
                                <td><strong>Author:</strong></td>
                                <td>{{$user->name}}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Acronym:</strong></td>
                        <td>{{$project->acronym}}</td>
                    </tr>

                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{$project->type}}</td>
                    </tr>
                    <tr>
                        <td><strong>Theme:</strong></td>
                        <td>{{$project->theme}}</td>
                    </tr>
                    @if($project->used_software)
                        <tr>
                            <td><strong>Used software:</strong></td>
                            <td>{{$project->used_software}}</td>
                        </tr>
                    @endif
                    @if($project->used_hardware)
                        <tr>
                            <td><strong>Used Hardware:</strong></td>
                            <td>{{$project->used_hardware}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{$project->description}}</td>
                    </tr>
                    @if($project->started_at)
                        <tr>
                            <td><strong>Started at</strong></td>
                            <td>{{$project->started_at}}</td>
                        </tr>
                    @endif
                    @if($project->finished_at)
                        <tr>
                            <td><strong>Finished at</strong></td>
                            <td>{{$project->finished_at}}</td>
                        </tr>
                    @else
                        <tr>
                            <td><strong>Finished at</strong></td>
                            <td>Not defined.</td>
                        </tr>

                    @endif
                    <tr>
                        <td><strong>Tags:</strong></td>
                        <td>
                            @foreach($tags as $tag)
                                {{$tag->tag}}<br>
                            @endforeach
                            @if(Auth::check() && ($project->created_by == Auth::user()->id || Auth::user()->role >= 2))
                                <br>
                                <a class="btn btn-primary" href="{{route('project_tag.add', [$project->id])}}" role="button">Tag Options</a>
                            @endif
                        </td>

                    </tr>
                    </tbody>

                </table>

            </div>

        </div>
        <td><strong>Media</strong></td>
        @foreach($medias as $media)
            {{$media->title}}
        @endforeach
        <br><br><br>

        <div class="panel panel-default">
            <div class="panel-heading">
                <p style="font-size: 20px; color: #23527c">Request Contact</p>
            </div>

            <div class="panel-body">
                <table>
                    <form action="{{route('comments.sendRequest', [$project->id])}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(!Auth::check())
                            <tr>
                                <input type="text" class="form-control" name=name placeholder="Enter your name here" value="{{old('name')}}">
                            </tr>
                            <br>
                        @endif
                        <tr>
                            <textarea name="message" class="form-control" style="resize: none; width:100%; height: 150px" placeholder="Write your message here">{{old('message')}}</textarea>

                        </tr>
                        <tr>
                            <br>
                            <td>
                                <button type="submit" class="btn btn-primary" >
                                    Request contact
                                </button>
                            </td>

                        </tr>
                    </form>
                </table>
            </div>

        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <p style="font-size: 20px; color: #23527c">Comment Section</p>
            </div>

            <div class="panel-body">
                <table>
                    <form action="{{route('comments.createComment', [$project->id])}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(!Auth::check())
                            <tr>
                                <input type="text" class="form-control" name="user_name" placeholder="Enter name" value="{{old('user_name')}}">
                            </tr>
                            <br>
                        @endif
                        <tr>
                            <textarea name="comment" class="form-control" style="resize: none; width:100%; height: 150px" placeholder="Write your comment here">{{old('comment')}}</textarea>

                        </tr>
                        <tr>
                            <br>
                            <td>
                                <button type="submit" class="btn btn-primary" >
                                    Submit comment
                                </button>
                            </td>

                        </tr>
                    </form>
                </table>
                <table class="table table-striped">
                    @foreach($comments as $comment)
                        @if($comment->approved_by != null)
                            <thead>
                            <tr>
                                <th>
                                    <br>
                                    @if($comment->user_id == null)
                                        <strong>{{$comment->user_name.' at '.$comment->created_at.':'}}</strong>
                                    @else
                                        @foreach($users as $user)
                                            @if($user->id == $comment->user_id)
                                                <strong> {{$user->name.' at '.$comment->created_at.':'}}</strong>
                                            @endif
                                        @endforeach
                                    @endif

                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                    <p>{{$comment->comment}}</p>
                                </td>

                            </tr>
                            @endif
                            @endforeach

                            </tbody>
                </table>
            </div>

        </div>

    </div>




@endsection('content')