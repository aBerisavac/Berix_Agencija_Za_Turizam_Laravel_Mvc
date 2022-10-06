@extends('pages.layouts.layout')
@section('description') Author information. @endsection
@section('title') Author @endsection
@section('header-text') About Author @endsection
@section('content')
    <main class="holder" id="main-author">
        <div>
            <img src="{{asset('assets/images/profile.jpg')}}" alt="author" />
            <p>My name is Aleksa Berisavac. I am currently attending the ICT Academy in Belgrade, orientation internet technologies. I am aspiring to be an accomplished web developer, and am working towards that goal. If you are wondering about my works, you can find them in the <a href="http://beri-portfolio-js-jquery.synergize.co/?i=2#about">Projects</a> section of my portfolio. </p>
        </div>
    </main>
@endsection
