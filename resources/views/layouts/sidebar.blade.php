<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <div class="col">
                    <i class="bi bi-grid"></i>
                    <span style="margin-left: -5px"> Dashboard</span>
                </div>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        @if (Auth::user()->kategori != 'SECTION')
        <li class="nav-heading">SUB DIVISI HC - KPI Individu</li>
        @endif

        @if (Auth::user()->kategori == 'MASTER' || Auth::user()->subdivisi == 'COMBEN')
        <!-- Comben, Payroll & PA Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin/subdivisi/comben') || Request::is('gl/subdivisi/comben') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpi', ['subdivisi' => 'comben']) : route('adminkpi', ['subdivisi' => 'comben']) }}">
                <i class="bi bi-credit-card"></i>
                <span>Comben, Payroll & PA</span>
            </a>
        </li>
        <!-- End Comben, Payroll & PA Nav -->
        @endif

        @if (Auth::user()->kategori == 'MASTER' || Auth::user()->subdivisi == 'REKRUT')
        <!-- Rekrutmen Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin/subdivisi/rekrut') || Request::is('gl/subdivisi/rekrut') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpi', ['subdivisi' => 'rekrut']) : route('adminkpi', ['subdivisi' => 'rekrut']) }}">
                <i class="bi bi-person-plus"></i>
                <span>Rekrutmen</span>
            </a>
        </li>
        <!-- End Rekrutmen Nav -->
        @endif

        @if (Auth::user()->kategori == 'MASTER' || Auth::user()->subdivisi == 'TND')
        <!-- Development Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin/subdivisi/tnd') || Request::is('gl/subdivisi/tnd') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpi', ['subdivisi' => 'tnd']) : route('adminkpi', ['subdivisi' => 'tnd']) }}">
                <i class="bi bi-command"></i>
                <span>Development</span>
            </a>
        </li>
        <!-- End Development Nav -->
        @endif

        @if (Auth::user()->kategori == 'MASTER' || Auth::user()->subdivisi == 'IR')
        <!-- Industrial Relation Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin/subdivisi/ir') || Request::is('gl/subdivisi/ir') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpi', ['subdivisi' => 'ir']) : route('adminkpi', ['subdivisi' => 'ir']) }}">
                <i class="bi bi-buildings"></i>
                <span>Industrial Relation</span>
            </a>
        </li>
        <!-- End Industrial Relation Nav -->
        @endif

        @if (Auth::user()->kategori == 'ADMIN')
        <!-- KPI Admin Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-kpi-approve') ? '' : 'collapsed' }}"
                href="{{ route('adminkpiapprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI Admin Approve</span>
            </a>
        </li>
        <!-- End KPI Admin Approve On Subdivisi Nav -->
        @endif

        @if (Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER')
        <!-- Pemeriksaan KPI Admin On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('check-admin-kpi*') ? '' : 'collapsed' }}"
                href="{{ route('checkAdminkpi', ['subdivisi' => Auth::user()->subdivisi ? Auth::user()->subdivisi : 'semua-subdivisi']) }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Pemeriksaan KPI Admin</span>
                </div>

                @if ($countKPI != 0)
                <div class="col-1">
                    <x-badge-sidebar :title="'Menunggu approve'" :count="$countKPI" />
                </div>
                @endif
            </a>
        </li>
        <!-- End Pemeriksaan KPI Admin On Subdivisi Nav -->

        <!-- KPI Admin Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-kpi-approve') ? '' : 'collapsed' }}"
                href="{{ route('adminkpiapprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI Admin Approve</span>
            </a>
        </li>
        <!-- End KPI Admin Approve On Subdivisi Nav -->
        @endif

        @if (Auth::user()->kategori == 'GROUP LEADER')
        <!-- KPI GL Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('gl-kpi-approve') ? '' : 'collapsed' }}"
                href="{{ route('glkpiapprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI GL Approve</span>
            </a>
        </li>
        <!-- End KPI GL Approve On Subdivisi Nav -->

        {{-- Pencapaian SF Individu --}}
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('pencapaian-sf-kpi-individu-gl') ? '' : 'collapsed' }}"
                href="{{ route('rekapglkpi') }}">
                <i class="bi bi-inboxes"></i>
                <span>Pencapaian SF Individu</span>
            </a>
        </li>
        {{-- Pencapaian SF Individu End --}}
        @endif

        {{-- KPI General --}}
        @if (Auth::user()->kategori != 'SECTION')
        <li class="nav-heading">SUB DIVISI HC - KPI General</li>
        @endif

        @if ((Auth::user()->kategori == 'MASTER' && Auth::user()->kategori != 'ADMIN') || Auth::user()->subdivisi ==
        'COMBEN')
        <!-- Comben, Payroll & PA Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-general/subdivisi/comben') || Request::is('gl-general/subdivisi/comben') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpiGeneral', ['subdivisi' => 'comben']) : route('adminkpiGeneral', ['subdivisi' => 'comben']) }}">
                <i class="bi bi-credit-card"></i>
                <span>Comben, Payroll & PA</span>
            </a>
        </li>
        <!-- End Comben, Payroll & PA Nav -->
        @endif

        @if ((Auth::user()->kategori == 'MASTER' && Auth::user()->kategori != 'ADMIN') || Auth::user()->subdivisi ==
        'REKRUT')
        <!-- Rekrutmen Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-general/subdivisi/rekrut') || Request::is('gl-general/subdivisi/rekrut') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpiGeneral', ['subdivisi' => 'rekrut']) : route('adminkpiGeneral', ['subdivisi' => 'rekrut']) }}">
                <i class="bi bi-person-plus"></i>
                <span>Rekrutmen</span>
            </a>
        </li>
        <!-- End Rekrutmen Nav -->
        @endif

        @if ((Auth::user()->kategori == 'MASTER' && Auth::user()->kategori != 'ADMIN') || Auth::user()->subdivisi ==
        'TND')
        <!-- Development Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-general/subdivisi/tnd') || Request::is('gl-general/subdivisi/tnd') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpiGeneral', ['subdivisi' => 'tnd']) : route('adminkpiGeneral', ['subdivisi' => 'tnd']) }}">
                <i class="bi bi-command"></i>
                <span>Development</span>
            </a>
        </li>
        <!-- End Development Nav -->
        @endif

        @if ((Auth::user()->kategori == 'MASTER' && Auth::user()->kategori != 'ADMIN') || Auth::user()->subdivisi ==
        'IR')
        <!-- Industrial Relation Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-general/subdivisi/ir') || Request::is('gl-general/subdivisi/ir') ? '' : 'collapsed' }}"
                href="{{ Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER' ? route('glkpiGeneral', ['subdivisi' => 'ir']) : route('adminkpiGeneral', ['subdivisi' => 'ir']) }}">
                <i class="bi bi-buildings"></i>
                <span>Industrial Relation</span>
            </a>
        </li>
        <!-- End Industrial Relation Nav -->
        @endif

        @if (Auth::user()->kategori == 'ADMIN')
        <!-- KPI Admin Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-kpi-general-approve') ? '' : 'collapsed' }}"
                href="{{ route('adminkpiGeneralApprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI Admin Approve</span>
            </a>
        </li>
        <!-- End KPI Admin Approve On Subdivisi Nav -->
        @endif

        @if (Auth::user()->kategori == 'GROUP LEADER' || Auth::user()->kategori == 'MASTER')
        <!-- Pemeriksaan KPI Admin On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-general/pemeriksaan') ? '' : 'collapsed' }}"
                href="{{ route('adminkpiGeneralCheck') }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Pemeriksaan KPI Admin</span>
                </div>
            </a>
        </li>
        <!-- End Pemeriksaan KPI Admin On Subdivisi Nav -->

        <!-- KPI Admin Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('admin-kpi-general-approve') ? '' : 'collapsed' }}"
                href="{{ route('adminkpiGeneralApprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI Admin Approve</span>
            </a>
        </li>
        <!-- End KPI Admin Approve On Subdivisi Nav -->
        @endif

        @if (Auth::user()->kategori == 'GROUP LEADER')
        <!-- KPI GL Approve On Subdivisi Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('gl-kpi-general-approve') ? '' : 'collapsed' }}"
                href="{{ route('glkpiGeneralApprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI GL Approve</span>
            </a>
        </li>
        <!-- End KPI GL Approve On Subdivisi Nav -->
        @endif

        @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
        <li class="nav-heading">SECTION HEAD</li>

        <!-- Rekrutmen Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('section/comben') ? '' : 'collapsed' }}"
                href="{{ route('section', ['subdivisi' => 'comben']) }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Comben, Payroll & PA</span>
                </div>

                @if ($countKPIGL['comben'] != 0)
                <div class="col-1">
                    <x-badge-sidebar :title="'Menunggu approve'" :count="$countKPIGL['comben']" />
                </div>
                @endif
            </a>
        </li>
        <!-- End Comben, Payroll & PA Nav -->

        <!-- Rekrutmen Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('section/rekrut') ? '' : 'collapsed' }}"
                href="{{ route('section', ['subdivisi' => 'rekrut']) }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Rekrutmen</span>
                </div>

                @if ($countKPIGL['rekrut'] != 0)
                <div class="col-1">
                    <x-badge-sidebar :title="'Menunggu approve'" :count="$countKPIGL['rekrut']" />
                </div>
                @endif
            </a>
        </li>
        <!-- End Rekrutmen Nav -->

        <!-- Development Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('section/tnd') ? '' : 'collapsed' }}"
                href="{{ route('section', ['subdivisi' => 'tnd']) }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Development</span>
                </div>

                @if ($countKPIGL['tnd'] != 0)
                <div class="col-1">
                    <x-badge-sidebar :title="'Menunggu approve'" :count="$countKPIGL['tnd']" />
                </div>
                @endif
            </a>
        </li>
        <!-- End Development Nav -->

        <!-- Industrial Relation Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('section/ir') ? '' : 'collapsed' }}"
                href="{{ route('section', ['subdivisi' => 'ir']) }}">
                <div class="col">
                    <i class="bi bi-inboxes"></i>
                    <span style="margin-left: -5px">Industrial Relation</span>
                </div>

                @if ($countKPIGL['ir'] != 0)
                <div class="col-1">
                    <x-badge-sidebar :title="'Menunggu approve'" :count="$countKPIGL['ir']" />
                </div>
                @endif
            </a>
        </li>
        <!-- End Industrial Relation Nav -->

        <!-- KPI GL Approve Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('gl-kpi-approve') ? '' : 'collapsed' }}"
                href="{{ route('glkpiapprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI GL Individu Approve</span>
            </a>
        </li>
        <!-- End KPI GL Approve Nav -->

        <!-- KPI GL General Pemeriksaan Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('gl-general/pemeriksaan') ? '' : 'collapsed' }}"
                href="{{ route('glkpiGeneralCheck') }}">
                <i class="bi bi-inboxes"></i>
                <span>Pemeriksaan KPI GL General</span>
            </a>
        </li>
        <!-- End KPI GL General Pemeriksaan Nav -->

        <!-- KPI GL General Approve Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('gl-kpi-general-approve') ? '' : 'collapsed' }}"
                href="{{ route('glkpiGeneralApprove') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI GL General Approve</span>
            </a>
        </li>
        <!-- End KPI GL General Approve Nav -->

        {{-- Pencapaian SF Individu --}}
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('pencapaian-sf-kpi-individu-gl') ? '' : 'collapsed' }}"
                href="{{ route('rekapglkpi') }}">
                <i class="bi bi-inboxes"></i>
                <span>Pencapaian SF KPI GL Individu</span>
            </a>
        </li>
        {{-- Pencapaian SF Individu End --}}

        <!-- KPI Section Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('section-kpi-general') ? '' : 'collapsed' }}"
                href="{{ route('sectionkpiGeneral') }}">
                <i class="bi bi-inboxes"></i>
                <span>KPI Section</span>
            </a>
        </li>
        <!-- End KPI Section Nav -->
        @endif

        <li class="nav-heading">DATA MASTER</li>

        <!-- Kamus Individu Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('kamus') ? '' : 'collapsed' }}" href="{{ route('kamus') }}">
                <i class="bi bi-journal-bookmark"></i>
                <span>Kamus KPI Individu</span>
            </a>
        </li>
        <!-- End Kamus Individu Nav -->

        <!-- Kamus General Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('kamus-general') ? '' : 'collapsed' }}"
                href="{{ route('kamusGeneral') }}">
                <i class="bi bi-journal-bookmark"></i>
                <span>Kamus KPI General</span>
            </a>
        </li>
        <!-- End Kamus General Nav -->

        @if (Auth::user()->kategori == 'MASTER')
        <!-- Periode Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('periode') ? '' : 'collapsed' }}"
                href="{{ route('periode') }}">
                <i class="bi bi-calendar2-date"></i>
                <span>Periode</span>
            </a>
        </li>
        <!-- End Periode Nav -->
        @endif

        <li class="nav-heading">ACCOUNT PAGES</li>

        <!-- Profile Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('profile') ? '' : 'collapsed' }}"
                href="{{ route('profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
        <!-- End Profile Nav -->

        @if (Auth::user()->kategori == 'MASTER')
        <!-- Users Nav -->
        <li class="nav-item">
            <a class="nav-link nav-link-load {{ Request::is('user') ? '' : 'collapsed' }}" href="{{ route('user') }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li>
        <!-- End Users Nav -->
        @endif

    </ul>

    @push('scripts')
    <script>
        // Proses Menampilkan Loading
            $(document).on('click', '.nav-link-load', function() {
                // Tampil loading
                $(".load").removeClass("d-none");
            });
    </script>
    @endpush

</aside>