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
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Created by</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th colspan="2" class="col-xs-1">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    @if($comment->approved_by != null)
                        <tr style="background-color: rgba(0, 255, 0, 0.30)">
                            @elseif($comment->refusal_msg != null)
                        <tr style="background-color: rgba(255, 0, 0, 0.30)">
                            @endif
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
                            @if($comment->approved_by != null && $comment->refusal_msg == null)
                                Approved
                            @elseif($comment->refusal_msg != null )
                               Refused: {{ $comment->refusal_msg }}
                            @else
                                 Waiting for approval
                            @endif
                        </td>
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
                            @if($comment->user_id != null)
                        <td>
                            <form action="{{route('editor.rejectComment' , [$comment->id])}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-warning">
                                    Reject
                                </button>
                            </form>
                        </td>
                                @endif
                        @endif
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

                </tbody>
            </table>
        @else
            <p class="well">There are no comments waiting for approval.</p>
        @endif
    </div>
</div>
@endsection