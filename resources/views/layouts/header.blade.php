<header id="header" class="header fixed-top d-flex align-items-center">

    <!-- Logo -->
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ url('/assets/icons/ICONPPA.png') }}" alt="">
            <span class="d-none d-lg-block">KPI HC - PPA</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <!-- Icons Navigation -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <!-- Profile Nav -->
            <li class="nav-item dropdown pe-3">

                <!-- Profile Iamge Icon -->
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ url('storage/foto_profil/' . Auth::user()->foto_profil) }}"
                        alt="{{ Auth::user()->foto_profil }}" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ ucfirst(Auth::user()->nama) }}</span>
                </a>
                <!-- End Profile Iamge Icon -->

                <!-- Profile Dropdown Items -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ ucfirst(Auth::user()->nama) }}</h6>
                        <span>
                            {{ Auth::user()->kategori . ' ' }}
                            @if (Auth::user()->subdivisi != null)
                                {{ Auth::user()->subdivisi }}
                            @endif
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}"
                            onclick="loading()">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" id="btnLogout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </button>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->

            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav>
    <!-- End Icons Navigation -->

    @push('scripts')
        <script>
            function loading() {
                $(".load").removeClass("d-none");
            }
            // Proses Logout
            $("#btnLogout").on("click", function(event) {

                // Tampilkan loading
                $(".load").removeClass("d-none");

                // Melakukan request AJAX
                $.ajax({
                    url: "{{ route('logout') }}",
                    success: function(response) {

                        if (response.status == "success") {
                            window.location.href = "/login";
                        }
                    },
                    error: function(error) {

                        // Alert
                        Swal.fire({
                            icon: "error",
                            title: "Error sistem",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }).always(function() {
                    // Hilangkan loading
                    $(".load").addClass("d-none");
                });
            });
        </script>
    @endpush
</header>
