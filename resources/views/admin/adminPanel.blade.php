@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <table>
                                <td>
                                    <h4><strong>Admin Options |</strong></h4>
                                </td>
                                <td>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary" style="color:white; margin-left: 10px">Register Account</a>
                                </td>
                            </tr>
                        </table>

                        </ul>
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
                        @if(count($users))
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th colspan="2" class="col-xs-1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name}}</td>
                                        <td>
                                            @if($user->role == 1)
                                                <p>Author</p>
                                            @elseif($user->role == 2)
                                                <p>Editor</p>
                                            @else
                                                <p style="color: #ac2925;"><strong>Administrator</strong></p>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('users.edit' , [$user->id])}}" role="button">Edit</a>
                                        </td>
                                        <td>
                                            @if($user->flags == 1)
                                                <a class="btn btn-danger" href="{{route('users.edit' , [$user->id])}}" role="button">Disable Account</a>
                                            @else
                                                <a class="btn btn-success" href="{{route('users.edit' , [$user->id])}}" role="button">Enable Account</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{route('users.destroy' , [$user->id])}}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="well">There are no users registered yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection