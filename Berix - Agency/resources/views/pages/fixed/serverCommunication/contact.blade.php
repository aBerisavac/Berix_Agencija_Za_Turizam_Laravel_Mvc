<div class="popup-whole-screen" id="contact-form">
    <div class="popup-wrapper">
        <h3>Message</h3>
        <hr/>
        <?php
        $inputId = ['contact-email', 'contact-message'];
        $inputLabelText = ['Enter your email: (optional)', 'Enter your message: *'];
        $inputPlaceholderText = ['', 'Maximum 200 letters.'];
        $inputSpanId = ['contact-email-span', 'contact-message-span'];
        $inputSpanText = ['', ''];
        $i=count($inputId);
        ?>
        <form action="{{route('contact')}}" method="get" id="contact-form" name="contact-form">
            @csrf
            @include('pages.partials.formInputElement')

            <hr/>
            <div class="button-group">
                <input type="button" class="return" value="Return"/>
                <input type="button" id="contact" value="Send message"/>
                <span id="contact-span">
                    @if(session()->has('contactIsSuccessfull')) You have successfully sent your message. @endif
                    @if(session()->has('contactErrors')) @foreach(session()->get('contactErrors') as $contactError) {{$contactError}} <br/><br/> @endforeach @endif

                </span>
            </div>
        </form>
    </div>
</div>
