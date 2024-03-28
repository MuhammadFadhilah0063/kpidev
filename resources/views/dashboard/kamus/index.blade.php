@extends('layouts.dashboard', ['pageTitle' => 'Data Kamus Individu'])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>Kamus Individu</a></li>
@endsection

@if (Auth::user()->kategori == 'MASTER')
    @push('button')
        <button class="btn btn-sm btn-primary fw-bold rounded" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modal">
            Tambah
        </button>
    @endpush
@endif

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

                        <div style="min-width: 200px"
                            class="ps-0 ps-sm-3 pt-3 pt-sm-0 flex-column flex-sm-row mx-auto mx-sm-0">
                            <div class="my-0 text-center text-sm-start">
                                <label for="filter_kategori" class="pb-2 fw-bold">Filter Kategori</label>
                            </div>
                            <select data-column="3" name="filter_kategori" id="filter_kategori" class="form-control select2"
                                style="max-width: 200px;">
                                <option value="">Pilih Filter</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="GROUP LEADER">GROUP LEADER</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive pt-3">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped table-hover table-bordered" id="tableData">
                        <thead class="table-danger">
                            <tr>
                                <th class="text-center text-nowrap">No.</th>
                                <th class="text-center text-nowrap">Point KPI</th>
                                <th class="text-center text-nowrap">Subdivisi</th>
                                <th class="text-center text-nowrap">Kategori</th>
                                <th class="text-center text-nowrap">Target</th>
                                <th class="text-center text-nowrap">Unit Target</th>
                                @if (Auth::user()->kategori == 'MASTER')
                                    <th class="text-center text-nowrap">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>

            @if (Auth::user()->kategori == 'MASTER')
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <button data-bs-toggle="modal" data-bs-target="#import" type="button"
                                class="btn btn-sm btn-warning fw-bold">
                                Import Excel
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Tambah dan Edit --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KAMUS BARU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Point KPI</label>
                            <input type="text" name="pointkpi" id="pointkpi" class="form-control" required
                                placeholder="point kpi">
                        </div>

                        <div class="form-group pt-3">
                            <label>Kategori</label>
                            <select class="form-control select3" name="kategori" id="kategori">
                                <option value="ADMIN">ADMIN</option>
                                <option value="GROUP LEADER">GROUP LEADER</option>
                            </select>
                        </div>

                        <div class="form-group pt-3">
                            <label>Subdivisi</label>
                            <select class="form-control select3" name="subdivisi" id="subdivisi">
                                <option value="COMBEN">COMBEN</option>
                                <option value="REKRUT">REKRUT</option>
                                <option value="TND">TND</option>
                                <option value="IR">IR</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-3">
                                <div class="form-group pt-3">
                                    <label>Target</label>
                                    <input type="text" name="target" id="target" class="form-control" required
                                        placeholder="target">
                                </div>
                            </div>

                            <div class="col-12 col-sm-9">
                                <div class="form-group pt-3">
                                    <label>Unit Target</label>
                                    <input type="text" name="unit_target" id="unit_target" class="form-control"
                                        required placeholder="unit target">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                        <button type="button" class="btn btn-primary btn-aksi">TAMBAH</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">IMPORT DATA EXCEL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kamusImport') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>PILIH FILE</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="text-center mt-2">
                            <small class="fst-italic">
                                <a class="btn btn-sm btn-danger" href="{{ url('assets/images/excel1.png') }}"
                                    target="_blank">
                                    Lihat contoh format isi excel
                                </a>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-primary">IMPORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Button add
                $('#btnAdd').on("click", function(event) {
                    $('#exampleModalLabel').html("TAMBAH KAMUS BARU");
                    $('.btn-aksi').html("TAMBAH");
                });

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
                            data: 'pointkpi'
                        },
                        {
                            data: 'subdivisi'
                        },
                        {
                            data: 'kategori'
                        },
                        {
                            data: 'target'
                        },
                        {
                            data: 'unit_target'
                        },
                        @if (Auth::user()->kategori == 'MASTER')
                            {
                                data: 'id',
                                render: function(data) {
                                    return `<button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                        <i class="bi bi-pencil-square"></i></button>&nbsp;
                                        <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                        <i class="bi bi-trash"></i></button>`;
                                }
                            },
                        @endif
                    ],
                    columnDefs: [{
                            targets: [0, 3, 4, 5],
                            className: "text-center align-middle text-capitalize text-nowrap"
                        },
                        {
                            targets: [2],
                            className: "text-center align-middle text-uppercase text-nowrap"
                        },
                        {
                            targets: [1],
                            className: "align-middle text-capitalize text-nowrap"
                        },
                        @if (Auth::user()->kategori == 'MASTER')
                            {
                                targets: [6],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                        @endif
                    ]
                });

                // Filter table
                $('#filter_subdivisi').change(function() {
                    dataTable.column($(this).data('column')).search($(this).val()).draw();
                });

                // Filter table
                $('#filter_kategori').change(function() {
                    dataTable.column($(this).data('column')).search($(this).val()).draw();
                });

                // Proses tambah dan update
                $(".btn-aksi").on("click", function(event) {
                    // Tampil loading
                    $(".load").removeClass("d-none");

                    if ($(".btn-aksi").text() == "EDIT") {
                        // Hapus invalid
                        clearInvalidInput(["pointkpi", "subdivisi", "target", "unit_target", "kategori"]);

                        // Mengambil nilai dari input
                        var formData = getValueInput(["pointkpi", "subdivisi", "target", "unit_target",
                            "kategori"
                        ]);

                        formData.append('_method', 'PUT');

                        // Ambil id
                        var id = $('.btn-aksi').attr("data-id");
                        var url = "kamus/" + id;
                    } else if ($(".btn-aksi").text() == "TAMBAH") {
                        // Hapus invalid
                        clearInvalidInput(["pointkpi", "subdivisi", "target", "unit_target", "kategori"]);

                        // Mengambil nilai dari input
                        var formData = getValueInput(["pointkpi", "subdivisi", "target", "unit_target",
                            "kategori"
                        ]);
                        var url = "kamus";
                    }

                    // Mengambil nilai token CSRF dari tag meta
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Melakukan request AJAX
                    $.ajax({
                        type: "POST",
                        url: url,
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

                // Proses edit
                $(document).on('click', '.btnEdit', function() {
                    var id = $(this).data('id');
                    $('#exampleModalLabel').html("EDIT DATA KAMUS");
                    $('.btn-aksi').html("EDIT");

                    // Menambahkan data-id pada button
                    $('.btn-aksi').attr("data-id", id);

                    $.ajax({
                        url: "kamus/" + id + "/edit",
                        success: (response) => {
                            $("#modal").modal("show");

                            if (response.kamus) {
                                $('#pointkpi').val(response.kamus.pointkpi);
                                $('#subdivisi').val(response.kamus.subdivisi).trigger('change');
                                $('#kategori').val(response.kamus.kategori).trigger('change');
                                $('#target').val(response.kamus.target);
                                $('#unit_target').val(response.kamus.unit_target);
                            }
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
                                url: "kamus/" + id,
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
                            showAlert('error', "Hapus dibatalkan, data kamus tetap aman :)");
                        }
                    });
                });

                // Proses tutup modal
                $('#modal').on('hidden.bs.modal', function() {
                    clearInput(["pointkpi", "subdivisi", "target", "unit_target"]);
                    clearInvalidInput(["pointkpi", "subdivisi", "target", "unit_target"]);

                    // Meghilangkan data-id pada button
                    $('.btn-aksi').removeAttr("data-id");
                });

                // select2
                $('.select3').select2({
                    dropdownParent: $('#modal'),
                    theme: 'bootstrap',
                });
            });
        </script>
    @endpush
    </div>
@endsection
