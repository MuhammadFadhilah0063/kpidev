@extends('layouts.dashboard', [
    'pageTitle' => 'Data KPI Admin ' . $subdivisi . ' Approve',
])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>KPI Admin {{ $subdivisi }} Approve</a></li>
@endsection

@section('content')
    <div class="col-lg-12">

        <div class="card">
            @if (Auth::user()->kategori != 'ADMIN')
                <div class="card-header">
                    <div class="d-flex flex-column flex-sm-row">
                        @if (Auth::user()->kategori == 'MASTER')
                            <div style="min-width: 120px" class="flex-column flex-sm-row mx-auto mx-sm-0">
                                <div class="my-0 text-center text-sm-start">
                                    <label for="filter_subdivisi" class="pb-2 fw-bold">Filter Sub Divisi</label>
                                </div>
                                <select data-column="6" name="filter_subdivisi" id="filter_subdivisi"
                                    class="form-control select2" style="max-width: 120px;">
                                    <option value="">Pilih Filter</option>
                                    <option value="COMBEN">COMBEN</option>
                                    <option value="REKRUT">REKRUT</option>
                                    <option value="TND">TND</option>
                                    <option value="IR">IR</option>
                                </select>
                            </div>
                        @endif

                        <div style="min-width: 250px"
                            class="ps-0 @if (Auth::user()->kategori == 'MASTER') ps-sm-3 @endif pt-3 pt-sm-0 flex-column flex-sm-row mx-auto mx-sm-0">
                            <div class="my-0 text-center text-sm-start">
                                <label for="filter_nama" class="pb-2 fw-bold">Filter Nama</label>
                            </div>
                            <select data-column="5" name="filter_nama" id="filter_nama" class="form-control select2"
                                style="max-width: 250px;">
                                <option value="">Pilih Filter</option>
                                @foreach ($adminUsers as $users)
                                    <option value="{{ ucfirst($users->nama) }}">
                                        {{ ucfirst($users->nama) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive pt-3">
                    <table class="table table-striped table-hover table-bordered" id="tableData">
                        <thead class="table-danger">
                            <tr>
                                <th class="text-center text-nowrap">No.</th>
                                <th class="text-center text-nowrap">Periode</th>
                                <th class="text-center text-nowrap">Point</th>
                                <th class="text-center text-nowrap">Aktual Realisasi</th>
                                <th class="text-center text-nowrap">Target</th>
                                <th class="text-center text-nowrap">Nama</th>
                                <th class="text-center text-nowrap">Sub Divisi</th>
                                <th class="text-center text-nowrap">Tanggal Approve</th>
                                <th class="text-center text-nowrap">File</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    // Datatable
                    var dataTable = $('#tableData').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url()->current() }}",
                        columns: [{
                                data: 'id',
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row, meta) {
                                    return new Intl.NumberFormat('id-ID').format(meta.row + meta.settings
                                        ._iDisplayStart + 1);
                                }
                            },
                            {
                                data: 'kpi.periode'
                            },
                            {
                                data: 'kpi.kamus.pointkpi'
                            },
                            {
                                data: 'kpi.aktual_realisasi'
                            },
                            {
                                data: 'kpi.kamus',
                                render: function(data) {
                                    return `${data.target} ${data.unit_target}`;
                                }
                            },
                            {
                                data: 'kpi.user.nama'
                            },
                            {
                                data: 'kpi.subdivisi'
                            },
                            {
                                data: 'created_at',
                                render: function(data) {
                                    var options = {
                                        day: "numeric",
                                        month: "long",
                                        year: "numeric",
                                    };

                                    // Tanggal dan waktu awal dalam format UTC
                                    var tanggalWaktuUTC = new Date(data);

                                    return new Intl.DateTimeFormat("id-ID", options).format(
                                        tanggalWaktuUTC);
                                }
                            },
                            {
                                data: 'kpi.file',
                                render: function(data) {
                                    if (data != null) {
                                        return `<a href="{{ asset('storage/file/${data}') }}"
                                    target="_blank" class="btn fw-bold btn-sm btn-info">
                                    <i class="bi bi-search"></i>
                                </a>`;
                                    } else {
                                        return "-";
                                    }
                                }
                            },
                        ],
                        columnDefs: [{
                                targets: [0, 1, 3, 4, 5, 6, 7, 8],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                            {
                                targets: [2],
                                className: "align-middle text-capitalize text-nowrap"
                            },
                        ]
                    });

                    // Filter table
                    $('#filter_subdivisi').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter table
                    $('#filter_nama').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });
                });
            </script>
        @endpush
    </div>
@endsection
