@extends('app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing <strong>{{$name.'\'s '}} </strong> account</div>
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
                        <form class="form-horizontal" role="form" method="POST" action="{{route('users.update', $id)}}">

                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name *</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $name) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address *</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $email) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Alternative E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="alternativeEmail" value="{{ old('alternativeEmail', $alt_email) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password </label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                    <p>Leave password filled blank if you do not want to edit the password.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password *</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Institution *</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="institution">
                                        @foreach($institutions as $institution)
                                            @if($institution->id == $institution_id)
                                                <option value="{{$institution->id}}" selected>{{$institution->name}}</option>
                                            @endif
                                                <option value="{{$institution->id}}">{{$institution->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Position *</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="position" value="{{ old('position', $position) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Profile Picture</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Profile URL</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="profile_url" value="{{ old('profile_url' , $profile_url) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">User Role *</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="role">
                                        @if($role == 1)
                                            <option value="1" selected>Author</option>
                                        @else
                                            <option value="1">Author</option>
                                        @endif
                                            @if($role == 2)
                                                <option value="2" selected>Editor</option>
                                            @else
                                                <option value="2">Editor</option>
                                            @endif
                                            @if($role == 4)
                                                <option value="4" selected>Administrator</option>
                                            @else
                                                <option value="4">Administrator</option>
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <label class="form-control" style="color:red; border-style: none">* fields are required</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">

                                    <button type="submit" class="btn btn-primary">
                                        Save Changes
                                    </button>
                                    <a href="{{ route('admin.index') }}" class="btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
