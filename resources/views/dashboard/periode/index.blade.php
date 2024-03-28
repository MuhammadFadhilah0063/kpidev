@extends('layouts.dashboard', ['pageTitle' => 'Data Periode'])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>Periode</a></li>
@endsection

@push('button')
    <button class="btn btn-sm btn-primary fw-bold rounded" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modal">
        Tambah
    </button>
@endpush

@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive pt-3">
                    <!-- Table with stripped rows -->
                    <table class="table table-striped table-hover table-bordered" id="tableData">
                        <thead class="table-danger">
                            <tr>
                                <th class="text-center text-nowrap">No.</th>
                                <th class="text-center text-nowrap">Periode</th>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH PERIODE BARU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Periode</label>
                                <input type="text" name="periode" id="periode" class="form-control" required
                                    placeholder="periode">
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

        @push('scripts')
            <script>
                $(document).ready(function() {

                    // Button add
                    $('#btnAdd').on("click", function(event) {
                        $('#exampleModalLabel').html("TAMBAH PERIODE BARU");
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
                                data: 'periode'
                            },
                            {
                                data: 'id',
                                render: function(data) {
                                    return `<button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                        <i class="bi bi-pencil-square"></i></button>&nbsp;
                                        <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                        <i class="bi bi-trash"></i></button>`;
                                }
                            },
                        ],
                        columnDefs: [{
                            targets: [0, 1, 2],
                            className: "text-center align-middle text-capitalize text-nowrap"
                        }]
                    });

                    // Proses tambah dan update
                    $(".btn-aksi").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        if ($(".btn-aksi").text() == "EDIT") {
                            // Hapus invalid
                            clearInvalidInput(["periode"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["periode"]);

                            formData.append('_method', 'PUT');

                            // Ambil id
                            var id = $('.btn-aksi').attr("data-id");
                            var url = "periode/" + id;
                        } else if ($(".btn-aksi").text() == "TAMBAH") {
                            // Hapus invalid
                            clearInvalidInput(["periode"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["periode"]);
                            var url = "periode";
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
                        $('#exampleModalLabel').html("EDIT DATA PERIODE");
                        $('.btn-aksi').html("EDIT");

                        // Menambahkan data-id pada button
                        $('.btn-aksi').attr("data-id", id);

                        $.ajax({
                            url: "periode/" + id + "/edit",
                            success: (response) => {
                                $("#modal").modal("show");

                                if (response.periode) {
                                    $('#periode').val(response.periode.periode);
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
                                    url: "periode/" + id,
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
                                showAlert('error', "Hapus dibatalkan, data periode tetap aman :)");
                            }
                        });
                    });

                    // Proses tutup modal
                    $('#modal').on('hidden.bs.modal', function() {
                        clearInput(["periode"]);
                        clearInvalidInput(["periode"]);

                        // Meghilangkan data-id pada button
                        $('.btn-aksi').removeAttr("data-id");
                    });

                });
            </script>
        @endpush
    </div>
@endsection
