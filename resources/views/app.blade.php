<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Header --}}
    <title>@yield('title') - SPINDRY</title>
    @include('components.header')
    @stack('style')
</head>

<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('components.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('page-heading')</h3>
            </div>

            {{-- Content --}}
            @yield('content')

            <footer>
                {{-- Footer --}}
                @include('components.footer')
            </footer>

        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/mazer.js') }}"></script>
    @stack('script')
</body>

</html>