@extends('app')

@section('content')

    <div class="container">

        <div class="page-header">
            <h1>Project Tags</h1>
            <a class="btn btn-primary" href="{{route('tag.add' , [$project->id])}}" role="button">Submit New Tag</a>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Approved Tags</h3>

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
                @if(count($tags))
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Tag</th>
                            <th colspan="2" class="col-xs-1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->tag}}</td>
                                <td>
                                    @if(in_array($tag->id, $project_tags))
                                        <a class="btn btn-danger" href="{{route('project_tag.removeFromProject' , [$tag->id, $project->id])}}" role="button">Remove from Project</a>
                                    @else
                                        <a class="btn btn-success" href="{{route('project_tag.addToProject' , [$tag->id, $project->id])}}" role="button">Add to Project</a>
                                    @endif
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

@endsection