@extends('app')

@section('content')
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Loreme ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
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
            @foreach($projects as $project)
                <a href="{{route('projects.show', [$project->id])}}">
                <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
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
        </div>
        <!-- /.row -->

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Last Updated</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>
    </div>
@endsection