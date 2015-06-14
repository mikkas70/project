@extends('app')

@section('content')
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            adicionar carousel aqui
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Featured Projects</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            @if(count($projects) > 0)
            @foreach($projects as $project)
                <a href="{{route('projects.show', [$project->id])}}">
                <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://images.visitcanberra.com.au/images/canberra_hero_image.jpg" alt="">
                    <div class="caption">
                        <h3>{{$project->name}}</h3>
                        <p>Theme: {{$project->theme}}.</p>
                        <p>Added at: {{$project->created_at}}.</p>
                        <p>
                            <a href="{{route('projects.show', [$project->id])}}" class="btn btn-primary">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
                </a>
            @endforeach
            @else
                <p>There are no featured Projects</p>
            @endif
        </div>
        <!-- /.row -->

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Updated Projects</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            @if(count($projects_updated ) > 0)
            @foreach($projects_updated as $project)
                <a href="{{route('projects.show', [$project->id])}}">
                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <img src="http://placehold.it/800x500" alt="">
                        <div class="caption">
                            <h3>{{$project->name}}</h3>
                            <p>Updated at:{{$project->updated_at}}</p>
                            <p>
                                <a href="{{route('projects.show', [$project->id])}}" class="btn btn-primary">More Info</a>
                            </p>
                        </div>
                    </div>
                </div>
                </a>
             @endforeach
             @endif
        </div>
        <!-- /.row -->


        <hr>
    </div>

@endsection