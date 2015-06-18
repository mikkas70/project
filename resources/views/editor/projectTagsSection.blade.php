@extends('editor')

@section('editor_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Project Tags Section</h3>

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
            @if(count($project_tags))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th colspan="2" class="col-xs-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($project_tags as $project_tag)
                        @if($project_tag->state == 1)
                            <tr style="background-color: rgba(0, 255, 0, 0.30)">
                                @elseif($project_tag->state == 2)
                            <tr style="background-color: rgba(255, 0, 0, 0.30)">
                        @else
                            <tr>
                                @endif
                                <td>
                                    {{$tags[$project_tag->id]}}
                                </td>
                                <td>
                                    {{$projects[$project_tag->id]}}
                                </td>
                                <td>
                                    @if($project_tag->state == 0)
                                        Waiting for approval
                                    @elseif($project_tag->state == 1)
                                        Approved
                                    @elseif($project_tag->state == 2)
                                        Refused
                                    @endif
                                </td>
                                <td>
                                    @if($project_tag->state == 0)
                                        <a class="btn btn-success" href="{{route('project_tag.approve' , [$project_tag->id])}}" role="button">Approve</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('project_tag.refuse' , [$project_tag->id])}}" role="button">Refuse</a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('project_tag.destroy' , [$project_tag->id])}}" method="post">
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
                <p class="well">There are no project tags.</p>
            @endif
        </div>
    </div>
@endsection