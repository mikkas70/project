@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Media Review</strong></div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($media->public_name != null)
                            <img src="{{'../'.$media->public_name}}" class="img-responsive center-block" >
                        @elseif($media->ext_url != null)
                            <div align="center" class="embed-responsive embed-responsive-16by9">
                                <iframe allowfullscreen="" src="{{$media->ext_url}}" frameborder="0"></iframe>
                            </div>
                        @endif
                        <br>

                        <form class="form-horizontal" role="form" method="POST" action="{{route('media.update', $media->id)}}">
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <table class="table table-striped">

                                <tr>
                                    <td>
                                        Title
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="title" value="{{$media->title, old('title')}}">
                                    </td>

                                </tr>
                                <tr>

                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="description" value="{{$media->description, old('description')}}">
                                    </td>
                                </tr>

                            </table>



                            <br>

                            <table>
                                <th>
                                    <a href="{{route('media.index')}}" class="btn btn-primary">Cancel</a>
                                </th>
                                <th>
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </th>
                                <th>
                                    <form action="{{route('media.destroy' , [$media->id])}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </th>
                            </table>
                        </form>

                        <table>
                            <tbody>
                            <br>

                            </tbody>
                        </table>
                    </div>
                </div>
                <table>

                    <form class="form-horizontal" role="form" method="post" action="{{route('media.refuse', $media->id)}}">
                    <table>
                        @if($media->approved_by == null && $media->refusal_msg == null)
                            <tr>
                                <td>
                                    Refusal reason:

                                </td>
                                <td>
                                    <input type="text" class="form-control" name="refusal_msg" placeholder="Enter the refusal reason here" value="{{old('refusal_msg')}}">
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endif
                    </table>
                    <th>
                        @if($media->approved_by == null && $media->refusal_msg == null)
                            <form action="{{route('media.approve' , [$media->id])}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                    </th>
                    <th>
                        <form action="{{route('media.refuse' , [$media->id])}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger">Refuse </button>
                        </form>
                    </th>
                        </form>
                     @endif
                </table>
            </div>

        </div>

    </div>

@endsection
