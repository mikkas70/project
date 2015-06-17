@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Media edit</strong></div>
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
                            <table>
                                <th>
                                    <a href="{{route('media.index')}}" class="btn btn-primary">Cancel</a>
                                </th>
                                <th>
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
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
            </div>
        </div>
    </div>

@endsection
