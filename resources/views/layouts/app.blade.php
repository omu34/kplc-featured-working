<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>kplc newsroom</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite('resources/css/app.css')
    @vite('resources/css/custom.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>
</head>



<body class="antialiased" x-cloak x-data="{ darkMode: $persist(false), zoomLevel: $persist(100), siteGrayscale: $persist(false) }" :class="{ 'dark': darkMode === true }"
    :style="'zoom: ' + zoomLevel + '%'">

    <div class="min-h-screen bg-gray-100">
        {{--  @livewire('navigation-menu')  --}}

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Page Heading -->
                    {{--  @include('newsroom.header')  --}}
                </div>
            </header>
        @endif



        <!-- Page Content -->
        <main>
            <div class="lg:ml-0 lg:mr-0 md:ml-4 ml-4 md:mr-4 mr-4 sm:ml-4 sm:mr-4">
                @yield('content')
            </div>
        </main>

        <div class="lg:ml-0 lg:mr-0 md:ml-4 ml-4 md:mr-4 mr-4 sm:ml-4 sm:mr-4">
            <!-- Page Footer -->
            {{--  @include('newsroom.footer')  --}}
        </div>
    </div>

    @stack('modals')




    @livewireScripts

    <script>
        document.addEventListener('search', function() {
            this.isLoading = true;
            this.error = null;
            fetch('/search?q=' + encodeURIComponent(this.search))
                .then(response => response.json())
                .then(data => {
                    this.results = data;
                })
                .catch(error => {
                    this.error = 'An error occurred during search.';
                })
                .finally(() => {
                    this.isLoading = false;
                });
        });
    </script>


    {{-- <script>
        document.addEventListener('livewire:load', function() {
            setInterval(function() {
                @this.call('nextItem')
            }, 90000); // 90 seconds
        });
    </script> --}}

    <template x-if="siteGrayscale">
        <style>
            img {
                filter: grayscale(100%) !Important;
            }
        </style>
    </template>

    <style>
        @font-face {
            font-family: Hilmar;
            /* src: url('/public/fonts/hilmar.tff'); */
            src: url('/hilmar.tff');
            font-weight: bold;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Hilmar !important;
        }
    </style>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
