<nav>
    <button id="btnMenu"><i class="fa fa-bars"></i> Menu</button>
    <ul>
        @foreach($navMenuItems as $navMenuItem)
                 @if(isset(session()->get('user')->first_name)&&!empty(session()->get('user'))&&$navMenuItem->href=='#') @continue  @endif
                 @if(!isset(session()->get('user')->first_name)&&empty(session()->get('user'))&&$navMenuItem->href=='logout') @continue  @endif
                 @if((!isset(session()->get('user')->first_name) || (session()->get('user')->role_id!=1)) && $navMenuItem->href=='admin') @continue @endif
            <a href="@if(strpos($navMenuItem->href, "#")!=0){{route($navMenuItem->href)}}@else{{$navMenuItem->href}}@endif">
                <li>
                    {{$navMenuItem->link_name}}
                </li>
            </a>
        @endforeach

    </ul>

</nav>

