@extends('editor')

@section('editor_content')
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3>Media Section</h3>

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
                    <form class="form-horizontal" role="form" method="get" action="{{route('media.index')}}">
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
                                        <option value="title" >Title</option>
                                        <option value="flags" >status</option>
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
        @if(count($medias))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th colspan="2" class="col-xs-1">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medias as $media)
                    @if($media->approved_by != null)
                        <tr style="background-color: rgba(0, 255, 0, 0.30)">
                            @elseif($media->refusal_msg != null)
                        <tr style="background-color: rgba(255, 0, 0, 0.30)">
                    @endif
                        <td>
                            {{$media->title}}
                        </td>
                        <td>
                            @if($media->approved_by != null)
                                Approved
                            @elseif($media->refusal_msg != null)
                                Refused: {{$media->refusal_msg}}
                            @else
                                <p>Waiting for approval</p>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('media.show' , [$media->id])}}" role="button">Review</a>
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
                {!! $medias->render() !!}

        @else
            <p class="well">There's no media waiting for approval.</p>
        @endif
    </div>
</div>
@endsection