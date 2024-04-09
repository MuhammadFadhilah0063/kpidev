@extends('layouts.dashboard', ['pageTitle' => 'Data KPI General Approve Group Leader ' . $subdivisi])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>KPI General Approve Group Leader {{ $subdivisi }}</a></li>
@endsection

@section('content')
    <div class="col-lg-12">

        <div class="card">

            @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                <div class="card-header">
                    <div class="d-flex flex-column flex-sm-row">
                        <div style="min-width: 120px" class="flex-column flex-sm-row mx-auto mx-sm-0">
                            <div class="my-0 text-center text-sm-start">
                                <label for="filter_subdivisi" class="pb-2 fw-bold">Filter Sub Divisi</label>
                            </div>
                            <select data-column="2" name="filter_subdivisi" id="filter_subdivisi"
                                class="form-control select2" style="max-width: 120px;">
                                <option value="">Pilih Filter</option>
                                <option value="COMBEN">COMBEN</option>
                                <option value="REKRUT">REKRUT</option>
                                <option value="TND">TND</option>
                                <option value="IR">IR</option>
                            </select>
                        </div>

                        <div style="min-width: 250px"
                            class="ps-0 ps-sm-3 pt-3 pt-sm-0 flex-column flex-sm-row mx-auto mx-sm-0">
                            <div class="my-0 text-center text-sm-start">
                                <label for="filter_periode" class="pb-2 fw-bold">Filter Periode</label>
                            </div>
                            <select data-column="1" name="filter_periode" id="filter_periode" class="form-control select2"
                                style="max-width: 250px;">
                                <option value="">Pilih Filter</option>
                                @foreach ($periodes as $periode)
                                    <option value="{{ ucfirst($periode->periode) }}">
                                        {{ ucfirst($periode->periode) }}
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
                                <th class="text-center text-nowrap">Sub Divisi</th>
                                <th class="text-center text-nowrap">KPI</th>
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
                                data: 'periode.periode'
                            },
                            {
                                data: 'subdivisi'
                            },
                            {
                                data: 'id',
                                render: function(data) {
                                    return `<a href="{{ url('gl-general/${data}/pdf') }}"
                                                target="_blank" class="btn fw-bold btn-sm btn-info">
                                                <i class="bi bi-filetype-pdf"></i>
                                            </a>`;
                                }
                            },
                            {
                                data: 'file',
                                render: function(data) {
                                    if (data != null) {
                                        return `<a href="{{ url('storage/file/${data}') }}"
                                                    target="_blank" class="btn fw-bold btn-sm btn-primary">
                                                    <i class="bi bi-search"></i>
                                                </a>`;
                                    } else {
                                        return "-";
                                    }
                                }
                            },
                        ],
                        columnDefs: [{
                            targets: [0, 1, 2, 3, 4],
                            className: "text-center align-middle text-capitalize text-nowrap"
                        }, ]
                    });

                    // Filter subdivisi
                    $('#filter_subdivisi').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter nama
                    $('#filter_nama').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter periode
                    $('#filter_periode').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });
                });
            </script>
        @endpush
    </div>
@endsection
