@include('pages.fixed.registration.login')
@include('pages.fixed.registration.register')
@include('pages.fixed.serverCommunication.contact')
<div id="scroll-to-top">
    <i class="fa-solid fa-arrow-up"></i>
</div>
<header class="holder">
    <a href="{{route('index')}}">
        <div id="header-logo">
            <img src="{{asset('assets/images/navLogo.png')}}" alt="Berix Logo"/>
        </div>
    </a>
    @include('pages.fixed.navigation')
    <div id="header-text">
        <h2> @yield('header-text') </h2>
    </div>
</header>

