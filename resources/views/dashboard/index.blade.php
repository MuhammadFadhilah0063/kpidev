@extends('layouts.dashboard', ['pageTitle' => 'Dashboard'])

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="col">
        <div class="row">

            {{-- Alert --}}
            @if (session()->has('login'))
                <div class="col-12">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="bi bi-star me-1"></i>
                        Selamat datang, {{ Auth::user()->nama }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            {{-- Alert End --}}

            @if (Auth::user()->kategori != 'SECTION')
                <!-- KPI Admin Card -->
                <div class="col-12 col-md-6">

                    <div class="card info-card no-card">

                        <div class="card-body">
                            <h5 class="card-title">Menunggu Approve</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="ps-3 ">
                                    <h6>KPI Admin</h6>
                                    <table>
                                        @if (Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'ADMIN')
                                            <tr>
                                                <td>
                                                    <span class="text-dark small pt-1 fw-bold">
                                                        {{ Auth::user()->subdivisi }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark small ps-2 pt-1 fw-bold">
                                                        &nbsp;: {{ $jumlahKPIAdminStatusWait[Auth::user()->subdivisi] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark small pt-1 fw-bold">
                                                        &nbsp;KPI
                                                    </span>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($jumlahKPIAdminStatusWait as $key => $kpi)
                                                <tr>
                                                    <td>
                                                        <span class="text-dark small pt-1 fw-bold">
                                                            {{ $key }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark small ps-2 pt-1 fw-bold">
                                                            &nbsp;: {{ $kpi }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark small pt-1 fw-bold">
                                                            &nbsp;KPI
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End KPI Admin Card -->
            @endif

            @if (Auth::user()->kategori != 'ADMIN')
                <!-- GL Admin Card -->
                <div class="col-12 col-md-6">

                    <div class="card info-card no-card">

                        <div class="card-body">
                            <h5 class="card-title">Menunggu Approve</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="ps-3 ">
                                    <h6>KPI Group Leader</h6>
                                    <table>
                                        @if (Auth::user()->kategori == 'GROUP LEADER')
                                            <tr>
                                                <td>
                                                    <span class="text-dark small pt-1 fw-bold">
                                                        {{ Auth::user()->subdivisi }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark small ps-2 pt-1 fw-bold">
                                                        &nbsp;: {{ $jumlahKPIGLStatusWait[Auth::user()->subdivisi] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-dark small pt-1 fw-bold">
                                                        &nbsp;KPI
                                                    </span>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($jumlahKPIGLStatusWait as $key => $kpi)
                                                <tr>
                                                    <td>
                                                        <span class="text-dark small pt-1 fw-bold">
                                                            {{ $key }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark small ps-2 pt-1 fw-bold">
                                                            &nbsp;: {{ $kpi }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark small pt-1 fw-bold">
                                                            &nbsp;KPI
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End GL Admin Card -->
            @endif

        </div>
    </div>

    @push('scripts')
        <script>
            // Proses hapus session login
            $(document).ready(() => {
                $.ajax({
                    url: "{{ route('clear-session-login') }}",
                });
            });
        </script>
    @endpush
@endsection
