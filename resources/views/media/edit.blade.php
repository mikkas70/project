@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing media: <strong>{{ $media->title }}</strong></div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('media.update', [$media->id])}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT" />

                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        Title
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name=title value="{{old('title', $media->title)}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        <textarea name="description" class="form-control" style="resize: none; width:100%; height: 150px">{{old('description', $media->description)}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Alt
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name=alt value="{{old('alt', $media->alt)}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        File Name
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name=filename value="{{old('filename', $media->filename)}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        External URL
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name=ext_url value="{{old('ext_url', $media->ext_url)}}">
                                    </td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                    <a class="btn" href="{{route('media.index')}}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')