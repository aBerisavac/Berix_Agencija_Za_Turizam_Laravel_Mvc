<div class="popup-whole-screen" id="login-form">
    <div class="popup-wrapper">
        <h3>Login</h3>
        <hr/>
        <?php
        $inputId = ['login-email', 'login-password'];
        $inputLabelText = ['Enter your email: *', 'Enter your password: *'];
        $inputPlaceholderText = ['', ''];
        $inputSpanId = ['login-email-span', 'login-password-span'];
        $inputSpanText = ['', ''];
        $i=count($inputId);
        ?>
        <form action="{{route('login')}}" method="Post" id="login-form" name="login-form">
            @csrf
            @include('pages.partials.formInputElement')

            <hr/>
            <div class="button-group">
                <input type="button" id="login" value="Login"/>
                <input type="button" class="register" value="Sign Up"/>
                <input type="button" class="return" value="Return"/>
                <span id="login-span">
                    @if(session()->has('registerIsSuccessfull')) You have successfully registered. @endif
                    @if(session()->has('registerErrors')) @foreach(session()->get('registerErrors') as $loginError) {{$loginError}} <br/><br/> @endforeach @endif

                </span>
            </div>
        </form>
    </div>
</div>
