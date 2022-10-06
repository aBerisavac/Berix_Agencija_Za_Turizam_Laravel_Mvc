@extends('pages.layouts.layout')
@section('description') Welcome page for Berix Agency @endsection
@section('title') Home - Page @endsection
@section('header-text') Welcome To Berix @endsection
@section('content')
    <main class="holder" id="main-index">
        <div id="destinations-holder" class="holder">
            @foreach($destinations as $destination)

                <div class="destination-holder">
                    <div class="carousel slide" data-bs-ride="carousel" data-id="{{$destination->id}}">
                        <div class="carousel-inner">
                            @foreach($destination->information_images as $image)
                            <div class="carousel-item @if( $loop->first) active @endif ">
                                <img src="{{asset('/assets/images/Destinations/'.$destination->name."/".$image->src.".jpg")}}" class="d-block w-100" alt="{{$image->alt}}">
                            </div>
                            @endforeach
                        </div>
{{--                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">--}}
{{--                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                            <span class="visually-hidden">Previous</span>--}}
{{--                        </button>--}}
{{--                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">--}}
{{--                            <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                            <span class="visually-hidden">Next</span>--}}
{{--                        </button>--}}
                    </div>
                    <div class="destination-information">
                        <h3>{{$destination->name}}</h3>
                        <p> Starting from {{$destination->cheapest_trip_price}} euros</p>
                    </div>
                </div>

            @endforeach
        </div>
    </main>
@endsection
