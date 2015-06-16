@extends('app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Users</h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-horizontal" role="form" method="get" action="{{route('users.show', 'false')}}">
                    <table class="table table-condensed">
                        <tr>
                            <th style="vertical-align: middle">
                                Search:
                            </th>
                            <th>
                                <input type="text" class="form-control" name="name" value="">
                            </th>
                            <th style="vertical-align: middle">
                                Sort by:
                            </th>
                            <th>
                                <select class="form-control" name="sort_by" >
                                    <option value="name" >Name</option>
                                    <option value="role" >Role</option>
                                </select>
                            </th>
                            <th style="vertical-align: middle">
                            Sort type:
                            </th>
                            <th>
                                <select class="form-control" name="sort_type">
                                    <option value="asc" >Ascendant</option>
                                    <option value="desc">Descendant</option>
                                </select>
                            </th>
                            <th style="vertical-align: middle">
                            Results per page:
                            </th>
                            <th>
                                <select class="form-control" name="results">
                                    <option value="5" >5</option>
                                    <option value="10" >10</option>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>User name</th>
                            <th>Role</th>
                            <th style="text-align: center">Number of Projects</th>
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
                                        <p style="color: #006600;"><strong>Editor</strong></p>
                                    @else
                                        <p style="color: #ac2925;"><strong>Administrator</strong></p>
                                    @endif
                                </td>

                                <td style="text-align: center">

                                        {{$projects[$user->id]}}


                                </td>
                                <td>
                                    <!-- Botões -->
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $users->render() !!}

                </div>
            </div>
        @else
            There are no User Accounts
        @endif
    </div>
@endsection('content')