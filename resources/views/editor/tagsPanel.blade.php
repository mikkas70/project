@extends('editor')

@section('editor_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Comment Section</h3>

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
            @if(count($comments))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Created by</th>
                        <th>Comment</th>
                        <th colspan="2" class="col-xs-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>
                                @if($comment->user_id != null)
                                    @foreach($users as $user)
                                        @if($comment->user_id == $user->id)
                                            <p style="color:#006600">{{ $user->name}}<p>
                                        @endif
                                    @endforeach
                                @else
                                    <p style="color:gray">{{ $comment->user_name}} (Unauthenticated)<p>
                                @endif
                            </td>
                            <td>{{ $comment->comment}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('comments.edit' , [$comment->id])}}" role="button">Edit</a>
                            </td>
                            @if($comment->approved_by == null)
                                <td>
                                    <form action="{{route('editor.approveContent' , [$comment->id])}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-success">
                                            Approve
                                        </button>
                                    </form>
                                </td>
                            @endif
                            @if($comment->refusal_msg == null)
                                <td>
                                    <form action="{{route('editor.rejectComment' , [$comment->id])}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <p class="well">There are no comments waiting for approval.</p>
            @endif
        </div>
    </div>
@endsection