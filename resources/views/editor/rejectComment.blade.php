@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Comment Rejection</strong></div>
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
                                        {{$user->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Project
                                    </td>
                                    <td>
                                        {{$project->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Comment:
                                    </td>
                                    <td>
                                        {{$comment->comment}}
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tbody>
                                <br>
                                <form action="{{route('comments.refuse' , [$comment->id])}}" method="POST">
                                    <input type="hidden" name="_method" value="put" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <input type="text" class="form-control" name="refusal_msg" placeholder="Enter the refusal reason here" value="{{old('refusal_msg')}}">                                <br>
                                </tr>
                                    <tr>
                                        <a href="{{route('editor.index')}}" class="btn btn-primary">Cancel</a>
                                    </tr>
                                    <tr>
                                        <button type="submit" class="btn btn-danger" style="margin-left: 10px">
                                            Reject
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
