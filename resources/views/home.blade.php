@extends('app')

@section('content')
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img_chania.jpg" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="img_chania2.jpg" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="img_flower.jpg" alt="Flower">
                    </div>

                    <div class="item">
                        <img src="img_flower2.jpg" alt="Flower">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
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


        <hr>
    </div>
@endsection