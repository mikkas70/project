@extends('app')

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1>Editor Options</h1>
                    <table>
                        <thead>Sections:</thead>
                        <td>
                            <a href="{{ route('editor.index') }}" class="btn btn-primary" style="color:white;">Comments</a>
                        </td>
                        <td>
                            <a href="{{ route('media.index') }}" class="btn btn-primary" style="color:white; margin-left: 10px">Media</a>
                        </td>
                        <td>
                            <form action="{{route('editor.projectsPanel')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary">
                                    Projects
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('editor.projectsPanel') }}" class="btn btn-primary" style="color:white; margin-left: 10px">Project Tags</a>
                        </td>
                    </table>
            </div>
           @yield('editor_content')
        </div>
    </div>
</div>
@endsection