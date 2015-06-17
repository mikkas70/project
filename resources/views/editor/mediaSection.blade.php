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
                    <tr>
                        <td>
                            {{$media->title}}
                        </td>
                        <td>
                            @if($media->approved_by != null)
                                <p style="color:green">Approved</p>
                            @elseif($media->refusal_msg != null)
                                <p style="color:red">Refused: {{$media->refusal_msg}}</p>
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