<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>LOGIN KPI HC - PPA</title>

    <!-- Favicons -->
    <link href="{{ url('/assets/icons/ICONPPA.png') }}" rel="icon">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/select2-bootstrap/dist/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.css') }}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="position-relative">

    {{-- Icon Loading --}}
    @include('layouts.loading')

    {{-- Main --}}
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <!-- Logo -->
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ url('/assets/icons/ICONPPA.png') }}" alt="">
                                    <span class="d-none d-lg-block">KPI HC - PPA</span>
                                </a>
                            </div>
                            <!-- End Logo -->

                            {{-- Alert --}}
                            <div class="alert-box w-100 d-none">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    <span class="text-alert"></span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            {{-- End Alert --}}

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 pt-0 fs-5">Masuk Ke Akun</h5>
                                    </div>

                                    {{-- Form --}}
                                    @yield('form')
                                    {{-- End Form --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>
    {{-- End Main --}}

    {{-- Button up --}}
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jQuery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Inisialisasi select2 --}}
    <script>
        $(document).ready(() => {
            $('.select2').select2({
                theme: 'bootstrap',
            });
        });
    </script>

    {{-- Scripts --}}
    @stack('scripts')

</body>

</html>