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

                            <form action="{{route('media.refuse' , [$media->id])}}" method="any">
                                <input type="hidden" name="_method" value="UPDATE" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        Title
                                    </td>
                                    <td>
                                        {{$media->title, old('title')}}
                                    </td>

                                </tr>
                                <tr>

                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        {{$media->description, old('description')}}
                                    </td>
                                </tr>
                                    <tr>
                                        <td>

                                            Status:

                                        </td>
                                        <td>
                                            @if($media->approved_by != null)
                                                <p style="color:green">Approved</p>
                                            @elseif($media->refusal_msg != null)
                                                <p style="color:red">Refused</p>
                                            @else
                                                <p> Waiting for Approval</p>


                                        </td>
                                    </tr>

                                @endif
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

                                    <td>
                                        <a href="{{route('media.index')}}" class="btn btn-primary">Cancel</a>                                    </td>
                                    <td>

                                        @if($media->approved_by == null && $media->refusal_msg == null)
                                            <button type="submit" class="btn btn-danger">Refuse </button>
                                        @endif
                                    </td>
                                </form>

                                        <td>
                                        @if($media->approved_by == null && $media->refusal_msg == null)
                                            <form action="{{route('media.approve' , [$media->id])}}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                        @endif
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











                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection