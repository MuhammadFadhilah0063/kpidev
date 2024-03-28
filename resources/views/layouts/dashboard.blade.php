{{-- Head --}}
@include('layouts.head')

{{-- Icon Loading --}}
@include('layouts.loading')

<body>

    {{-- Header --}}
    @include('layouts.header')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main --}}
    <main id="main" class="main">

        <div class="row">
            <!-- Page Title -->
            <div class="col-9">
                <div class="pagetitle">
                    <h1>{{ $pageTitle }}</h1>
                    <nav>
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End Page Title -->

            {{-- Button --}}
            <div class="col-3 d-flex align-items-center justify-content-end">
                @stack('button')
            </div>
            {{-- End Button --}}
        </div>

        <section class="section dashboard">
            <div class="row">
                {{-- Content --}}
                @yield('content')
            </div>
        </section>

    </main>
    {{-- End Main --}}

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Button up --}}
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">
        </i>
    </a>

    {{-- Scripts --}}
    @include('layouts.scripts')

</body>

</html>
