    <footer>
        <div class="holder" id="footer-wrapper">
            <div id="footer-copyright">
                <p>&copy; 2022 Berix - Agency, Berisavac Aleksa 32/18 IT </p><hr/>
            </div>
            <div id="footer-links" class="holder">
                @foreach($footerLinks as $footerLink)
                    <a href="{{asset('assets/'.$footerLink->src)}}">
                        <i class="{{$footerLink->fa_fa}}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </footer>

</body>
</html>
