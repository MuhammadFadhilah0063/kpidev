@extends('layouts.dashboard', ['pageTitle' => 'Pemeriksaan Data KPI Admin ' . $subdivisi])

@section('breadcrumb')
<li class="breadcrumb-item active"><a>Pemeriksaan KPI Admin {{ $subdivisi }}</a></li>
@endsection

@section('content')
<div class="col-lg-12">

    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row">
                @if (Auth::user()->kategori == 'MASTER')
                <div style="min-width: 120px" class="flex-column flex-sm-row mx-auto mx-sm-0">
                    <div class="my-0 text-center text-sm-start">
                        <label for="filter_subdivisi" class="pb-2 fw-bold">Filter Sub Divisi</label>
                    </div>
                    <select data-column="6" name="filter_subdivisi" id="filter_subdivisi" class="form-control select2"
                        style="max-width: 120px;">
                        <option value="">Pilih Filter</option>
                        <option value="COMBEN">COMBEN</option>
                        <option value="REKRUT">REKRUT</option>
                        <option value="TND">TND</option>
                        <option value="IR">IR</option>
                    </select>
                </div>
                @endif
                <div style="min-width: 250px"
                    class="ps-0 @if (Auth::user()->kategori == 'MASTER') ps-sm-3 @endif  pt-3 pt-sm-0 flex-column flex-sm-row mx-auto mx-sm-0">
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

        <div class="card-body">
            <div class="table-responsive pt-3">
                <!-- Table with stripped rows -->
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
                            <th class="text-center text-nowrap">File</th>
                            <th class="text-center text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Reject KPI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="formReject">
                        <div class="form-group">
                            <label>Alasan</label>
                            <textarea name="alasan" id="alasan" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                    <button type="button" class="btn btn-danger btn-reject">Reject</button>
                    </form>
                </div>
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
                                data: 'periode'
                            },
                            {
                                data: 'kamus.pointkpi'
                            },
                            {
                                data: 'aktual_realisasi'
                            },
                            {
                                data: 'kamus',
                                render: function(data) {
                                    return `${data.target} ${data.unit_target}`;
                                }
                            },
                            {
                                data: 'user.nama'
                            },
                            {
                                data: 'subdivisi'
                            },
                            {
                                data: 'file',
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
                            {
                                data: 'id',
                                render: function(data) {
                                    return `
                                    <button data-bs-toggle="modal" data-bs-target="#modal" title="Reject" class="btnReject btn fw-bold btn-sm btn-secondary d-inline" data-id="${data}"><i class="bi bi-x-square"></i></button>
                                    <button title="Approve" class="btnApprove btn fw-bold btn-sm btn-success d-inline" data-id="${data}"><i class="bi bi-check-square"></i></button>
                                    <button title="Delete" class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}"><i class="bi bi-trash"></i></button>`;
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

                    // select2
                    $('.select3').select2({
                        dropdownParent: $('#modal'),
                        theme: 'bootstrap',
                    });

                    // Proses menampilkan modal reject
                    $(document).on('click', '.btnReject', function() {

                        var id = $(this).data('id');

                        var inputId = `<input type="hidden" id="id" value="${id}">`;
                        var formReject = $('#formReject');
                        formReject.append(inputId);

                    });

                    // Proses reject
                    $(".btn-reject").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        // Hapus invalid
                        clearInvalidInput(["alasan"]);

                        // Mengambil nilai dari input
                        var formData = getValueInput(["alasan", "id"]);

                        // Mengambil nilai token CSRF dari tag meta
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Melakukan request AJAX
                        $.ajax({
                            type: "POST",
                            url: "{{ url()->current() }}/reject",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {

                                if (response.status == "success") {

                                    // Alert
                                    showAlert('success', response.message);

                                    // Tutup modal
                                    $("#modal").modal("hide");

                                    // reload table
                                    dataTable.ajax.reload();
                                } else {
                                    // Alert
                                    showAlert('error', response.message);

                                    // Menambah Invalid
                                    addInvalidInput(response.errors);
                                }
                            },
                            error: function(error) {
                                // Alert
                                showAlert('error', "Error sistem");
                            }
                        }).always(function() {
                            // Hilangkan loading
                            $(".load").addClass("d-none");
                        });
                    });

                    // Proses approve
                    $(document).on('click', '.btnApprove', function() {

                        Swal.fire({
                            title: "Approve?",
                            text: "Data tidak bisa dikembalikan!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Ya, approve!",
                            cancelButtonText: "Tidak, batal!",
                            reverseButtons: true,
                            confirmButtonColor: "rgba(220, 20, 60, 0.879)",
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // Tampil loading
                                $(".load").removeClass("d-none");

                                var id = $(this).data('id');

                                // Mengambil nilai token CSRF dari tag meta
                                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                                // Melakukan request AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url()->current() }}/approve",
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: {
                                        'id': id
                                    },
                                    success: function(response) {

                                        if (response.status == "success") {

                                            // Alert
                                            showAlert('success', response.message);

                                            // Tutup modal
                                            $("#modal").modal("hide");

                                            // reload table
                                            dataTable.ajax.reload();
                                        } else {
                                            // Alert
                                            showAlert('error', response.message);

                                            // Menambah Invalid
                                            addInvalidInput(response.errors);
                                        }
                                    },
                                    error: function(error) {
                                        // Alert
                                        showAlert('error', "Error sistem");
                                    }
                                }).always(function() {
                                    // Hilangkan loading
                                    $(".load").addClass("d-none");
                                });
                            } else if (
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                // Alert
                                showAlert('error', "Approve dibatalkan!");
                            }
                        });
                    });

                    // Proses delete
                    $(document).on('click', '.btnHapus', function() {

                        Swal.fire({
                            title: "Yakin hapus?",
                            text: "Data tidak bisa dikembalikan!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Ya, hapus!",
                            cancelButtonText: "Tidak, batal!",
                            reverseButtons: true,
                            confirmButtonColor: "rgba(220, 20, 60, 0.879)",
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // Tampil loading
                                $(".load").removeClass("d-none");

                                var id = $(this).data('id');

                                // Mengambil nilai token CSRF dari tag meta
                                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                                // Melakukan request AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url()->current() }}/" + id,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: {
                                        '_method': 'DELETE'
                                    },
                                    success: function(response) {

                                        if (response.status == "success") {

                                            // Alert
                                            showAlert('success', response.message);

                                            // Tutup modal
                                            $("#modal").modal("hide");

                                            // reload table
                                            dataTable.ajax.reload();
                                        } else {
                                            // Alert
                                            showAlert('error', response.message);

                                            // Menambah Invalid
                                            addInvalidInput(response.errors);
                                        }
                                    },
                                    error: function(error) {
                                        // Alert
                                        showAlert('error', "Error sistem");
                                    }
                                }).always(function() {
                                    // Hilangkan loading
                                    $(".load").addClass("d-none");
                                });
                            } else if (
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                // Alert
                                showAlert('error', "Hapus dibatalkan, data tetap aman :)");
                            }
                        });
                    });

                    // Proses tutup modal
                    $('#modal').on('hidden.bs.modal', function() {
                        clearInput(["alasan"]);
                        clearInvalidInput(["alasan"]);

                        // Meghilangkan data-id pada button
                        $('.btn-aksi').removeAttr("data-id");
                    });

                });
    </script>
    @endpush
</div>
@endsection