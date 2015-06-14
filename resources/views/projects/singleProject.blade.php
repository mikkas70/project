@extends('app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Project Details</h1>
        </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody style="width: 100px">
                    <tr style="">
                      <td><strong>Project Name:</strong></td>
                      <td>{{$project->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Acronym:</strong></td>
                        <td>{{$project->acronym}}</td>
                    </tr>
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{$project->description}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{$project->type}}</td>
                    </tr>
                    <tr>
                        <td><strong>Theme:</strong></td>
                        <td>{{$project->theme}}</td>
                    </tr>
                </tbody>
            </table>
    </div>
@endsection('content')