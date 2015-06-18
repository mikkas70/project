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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form class="form-horizontal" role="form" method="get" action="{{route('editor.index')}}">
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
                                        <option value="comment" >comment</option>
                                        <option value="state" >status</option>
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
                                        <option value="10" selected >10</option>
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
        @if(count($comments))
            <table class="table table-striped">
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
                {!! $comments->render() !!}

            @else
            <p class="well">There are no comments waiting for approval.</p>
        @endif
    </div>
</div>
@endsection