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
                        <tr>
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
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <p class="well">There's no media waiting for approval.</p>
            @endif
        </div>
    </div>
@endsection