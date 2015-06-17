@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Edit Comment</strong></div>
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
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        Created by
                                    </td>
                                    <td>
                                        {{$user}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Project
                                    </td>
                                    <td>
                                        {{$project_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Comment
                                    </td>
                                    <form action="{{route('comments.update' , [$comment->id])}}" method="POST">
                                    <td>
                                        <textarea name="comment" class="form-control" style="resize: none; width:100%; height: 150px">{{$comment->comment, old('comment')}}</textarea>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tbody>
                                <br>
                                    <input type="hidden" name="_method" value="put" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <tr>
                                        <a href="{{route('editor.index')}}" class="btn btn-primary">Cancel</a>
                                    </tr>
                                    <tr>
                                        <button type="submit" class="btn btn-success" style="margin-left: 10px">
                                            Edit Comment
                                        </button>
                                    </tr>
                                </form>
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
