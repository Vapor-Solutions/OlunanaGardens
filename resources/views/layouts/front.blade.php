<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Olunana Gardens</title>
    <link rel="shortcut icon" href="/img/favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Barlow&family=Barlow+Condensed&family=Gilda+Display&display=swap">
    <link rel="stylesheet" href="/css/plugins.css" />
    <link rel="stylesheet" href="/css/style.css" />

    @vite(['resources/sass/front.scss'])
    @livewireStyles
    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Menu -->
    {{-- <div class="cappa-wrap">
        <div class="cappa-wrap-inner">
            <x-front.sidebar-links></x-front.sidebar-links>
            <div class="cappa-menu-footer">
                <x-front.reservations></x-front.reservations>
            </div>
        </div>
    </div> --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="">
                </a>
                <!-- <a class="logo" href="index.html"> <h2>THE CAPPA <span>Luxury Hotel</span></h2> </a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <x-front.sidebar-links></x-front.sidebar-links>
                </ul>
            </div>
        </div>
    </nav>



    {{ $slot }}

    <x-front.footer></x-front.footer>

    @stack('modals')


    <script src="/js/jquery-3.6.3.min.js"></script>
    <script src="/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="/js/modernizr-2.6.2.min.js"></script>
    <script src="/js/imagesloaded.pkgd.min.js"></script>
    <script src="/js/jquery.isotope.v3.0.2.js"></script>
    <script src="/js/pace.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scrollIt.min.js"></script>
    <script src="/js/jquery.waypoints.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.stellar.min.js"></script>
    <script src="/js/jquery.magnific-popup.js"></script>
    <script src="/js/YouTubePopUp.js"></script>
    <script src="/js/select2.js"></script>
    <script src="/js/datepicker.js"></script>
    <script src="/js/smooth-scroll.min.js"></script>
    <script src="/js/vegas.slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/custom.js?{{ rand(1, 670) }}"></script>
    @livewireScripts
    @stack('scripts')
    <!-- Vegas Background Slideshow (vegas.slider kenburns) -->
    <script>
        $(document).ready(function() {
            $('#kenburnsSliderContainer').vegas({
                slides: [{
                    src: "img/slider/1.jpg"
                }, {
                    src: "img/slider/2.jpg"
                }, {
                    src: "img/slider/3.jpg"
                }],
                overlay: true,
                transition: 'fade2',
                animation: 'kenburnsUpRight',
                transitionDuration: 1000,
                delay: 10000,
                animationDuration: 20000
            });
        });
    </script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            timer: 5000,
            timerProgressBar: true
        })




        window.Toast = Toast
        Livewire.on('done', (e) => {
            if (e.success) {
                Toast.fire({
                    icon: 'success',
                    text: e.success
                })
            }
            if (e.warning) {
                Toast.fire({
                    icon: 'warning',
                    text: e.warning
                })
            }
            if (e.info) {
                Toast.fire({
                    icon: 'info',
                    text: e.info
                })
            }
            if (e.error) {
                Toast.fire({
                    icon: 'error',
                    text: e.error
                })
            }

            $('.modal').modal('hide');
        });
    </script>
</body>

</html>
