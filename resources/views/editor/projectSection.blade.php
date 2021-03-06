@extends('editor')

@section('editor_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Project Section</h3>

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
                        <form class="form-horizontal" role="form" method="get" action="{{route('projects.projectsPanel')}}">
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
                                            <option value="name" >Title</option>
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
            @if(count($projects))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
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
                                @endif
                                <td>
                                    {{$project->name}}
                                </td>
                                <td>
                                    @if($project->approved_by != null)
                                        Approved
                                    @elseif($project->refusal_msg != null)
                                        Refused: {{$project->refusal_msg}}
                                    @else
                                        <p>Waiting for approval</p>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('projects.review' , [$project->id])}}" role="button">Review</a>
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

                    </tbody>
                </table>
                    {!! $projects->render() !!}
                @else
                <p class="well">There's no media waiting for approval.</p>
            @endif
        </div>
    </div>
@endsection