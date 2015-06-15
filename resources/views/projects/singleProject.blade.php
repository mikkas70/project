@extends('app')

@section('content')
    <div class="container">

        <div class="page-header">
            <h1>Project Details</h1>
        </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody style="width: 100px">
                    <tr style="">
                      <td><strong>Project Name:</strong></td>
                      <td>{{$project->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Acronym:</strong></td>
                        <td>{{$project->acronym}}</td>
                    </tr>
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{$project->description}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{$project->type}}</td>
                    </tr>
                    <tr>
                        <td><strong>Theme:</strong></td>
                        <td>{{$project->theme}}</td>
                    </tr>
                </tbody>
            </table>


        <td><strong>Media</strong></td>
        @foreach($medias as $media)
            {{$media->title}}
        @endforeach
        <div class="panel panel-default">
            <div class="panel-heading">
                <p style="font-size: 20px; color: #23527c">Comment Section</p>
            </div>

            <div class="panel-body">


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