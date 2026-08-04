<header class="header hdr2">
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2713631168976653');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=2713631168976653&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <div class="hdr-cont">
        <div class="container">
            <div class="header-conts">
                <div class="hdr-logos">
                    <a href="/"><img src="./assets/logo/logo3.png" alt=""></a>
                    <img src="./assets/logo/1.png" alt="">
                </div>
                <div class="pg-cnt-btn">
                    {{-- <div class="pages">
                        <a href="#about"><p>About Us</p></a>
                        <a href=""><p>Members</p></a>
                        <a href=""><p>latest Cuts</p></a>
                        <a href=""><p>Partners</p></a>
                    </div> --}}
                    <a href="#cnct">
                        <div class="ind-cnct-btn">
                            <p>Contact</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
