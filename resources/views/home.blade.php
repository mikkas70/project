@extends('app')

@section('content')
    <link href="{{ asset('/css/carousel.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="{{ asset('/css/carousel.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/jquery-ui-1.10.4.custom.min.css') }}">

    <div class="container">

        <!-- Jumbotron Header -->
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
                    <?php  $active = true ?>
                    @foreach($projects_featured_images as $project)

                        @if($projects_image[$project->id]->public_name !=null && $active)


                                    <div class="item active">
                                    <img class="img-responsive center-block" src="{{$projects_image[$project->id]->public_name}}">

                                        <a href="{{route('projects.show', [$project->id])}}">
                                        <div class="carousel-caption">

                                    <p style="color:black; font-size: 20px">{{$project->name}}.</p>
                                </div>
                                        </a>
                            </div>

                            <?php $active = false ?>

                        @else
                            <div class="item">
                                <img class="img-responsive center-block" src="{{$projects_image[$project->id]->public_name}}">
                                <a href="{{route('projects.show', [$project->id])}}">
                                <div class="carousel-caption">
                                    <p style="color:black; font-size: 20px">{{$project->name}}.</p>
                                </div>
                                    </a>
                            </div>
                        @endif
                    @endforeach

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
                    @if($projects_image[$project->id]->public_name == null)
                        <img src="http://placehold.it/800x500">
                    @else
                        <img src="{{$projects_image[$project->id]->public_name}}">
                    @endif

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
                        @if($projects_updated_image[$project->id]->public_name == null)
                            <img src="http://placehold.it/800x500">
                        @else
                            <img src="{{$projects_updated_image[$project->id]->public_name}}">
                        @endif
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