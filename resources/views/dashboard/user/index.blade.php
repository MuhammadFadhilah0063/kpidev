@extends('layouts.dashboard', ['pageTitle' => 'Data User'])

@section('breadcrumb')
<li class="breadcrumb-item active"><a>User</a></li>
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
                            <th class="text-center text-nowrap">NRP</th>
                            <th class="text-center text-nowrap">Nama</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Sub Divisi</th>
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
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH USER BARU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <label>NRP</label>
                            <input type="text" name="nrp" id="nrp" class="form-control" required placeholder="nrp">
                        </div>

                        <div class="form-group pt-3">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required placeholder="nama">
                        </div>

                        <div class="form-group pt-3">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-control select3">
                                <option value="ADMIN">ADMIN</option>
                                <option value="GROUP LEADER">GROUP LEADER</option>
                                <option value="SECTION">SECTION</option>
                                <option value="MASTER">MASTER</option>
                            </select>
                        </div>

                        <div class="form-group pt-3">
                            <label>Sub Divisi</label>
                            <select name="subdivisi" id="subdivisi" class="form-control select3">
                                <option value="">Tidak Ada Sub Divisi</option>
                                <option value="COMBEN">COMBEN</option>
                                <option value="REKRUT">REKRUT</option>
                                <option value="TND">TND</option>
                                <option value="IR">IR</option>
                            </select>
                        </div>

                        <div class="form-group pt-3">
                            <label>Foto Profil</label>
                            <input type="file" name="foto_profil" id="foto_profil" class="form-control" accept="image/*"
                                onchange="previewImage(this);">
                            <small class="fst-italic">
                                Pilih file foto, jika ingin upload foto profil.
                            </small>
                        </div>

                        {{-- Image Preview --}}
                        <div class="col-12 text-center pt-3 div-image-preview">
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid img-thumbnail"
                                style="display:none; max-width: 100%; max-height: 300px; margin: 0 auto;">
                        </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                    <button type="button" class="btn btn-primary btn-aksi">TAMBAH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Function Image Preview
                function previewImage(input) {
                    var preview = document.getElementById('imagePreview');
                    var file = input.files[0];
                    var reader = new FileReader();

                    reader.onloadend = function() {
                        preview.src = reader.result;
                        preview.style.display = 'block';
                    };

                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '#';
                        preview.style.display = 'none';
                    }
                }

                $(document).ready(function() {

                    // Button add
                    $('#btnAdd').on("click", function(event) {
                        $('#exampleModalLabel').html("TAMBAH USER BARU");
                        $('.btn-aksi').html("TAMBAH");
                        $('.div-image-preview').after(
                            "<div class='div-password'><div class='form-group pt-3'><label>Password</label><input type='password' name='password' id='password' class='form-control'></div></div>"
                        );
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
                                data: 'nrp'
                            },
                            {
                                data: 'nama'
                            },
                            {
                                data: 'kategori'
                            },
                            {
                                data: 'subdivisi',
                                render: function(data) {
                                    return data ?? "-";
                                }
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
                                targets: [0, 1, 3, 4, 5],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                            {
                                targets: [2],
                                className: "align-middle text-capitalize text-nowrap"
                            },
                        ]
                    });

                    // select2
                    $('.select3').select2({
                        dropdownParent: $('#modal'),
                        theme: 'bootstrap',
                    });

                    // Proses tambah dan update
                    $(".btn-aksi").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        if ($(".btn-aksi").text() == "EDIT") {
                            // Hapus invalid
                            clearInvalidInput(["nrp", "nama", "password_lama", "password_baru"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["nrp", "nama", "password_lama", "password_baru",
                                "kategori", "subdivisi"
                            ]);

                            formData.append('_method', 'PUT');

                            // Ambil id
                            var id = $('.btn-aksi').attr("data-id");
                            var url = "user/" + id;
                        } else if ($(".btn-aksi").text() == "TAMBAH") {
                            // Hapus invalid
                            clearInvalidInput(["nrp", "nama", "password"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["nrp", "nama", "password", "kategori", "subdivisi"]);
                            var url = "user";
                        }

                        // Mengambil input file foto
                        var fileInput = document.getElementById("foto_profil");
                        var file = fileInput.files[0];

                        if (file) {
                            formData.append("foto_profil", file);
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
                        $('#exampleModalLabel').html("EDIT DATA USER");
                        $('.btn-aksi').html("EDIT");

                        // Menambahkan data-id pada button
                        $('.btn-aksi').attr("data-id", id);

                        $.ajax({
                            url: "user/" + id + "/edit",
                            success: (response) => {
                                $("#modal").modal("show");

                                if (response.user) {
                                    $('#nrp').val(response.user.nrp);
                                    $('#nama').val(response.user.nama);
                                    $('#subdivisi').val(response.user.subdivisi).trigger('change');
                                    $('#kategori').val(response.user.kategori).trigger('change');

                                    if (response.user.foto_profil) {
                                        showImagePreview(response.user.foto_profil);
                                    }

                                    $('.div-image-preview').after(
                                        "<div class='div-password'><div class='form-group pt-3'><label>Password Lama</label><input type='password' name='password_lama' id='password_lama' class='form-control'></div><div class='form-group pt-3'><label>Password Baru</label><input type='password' name='password_baru' id='password_baru' class='form-control'></div></div>"
                                    );
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
                                    url: "user/" + id,
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
                                showAlert('error', "Hapus dibatalkan, data user tetap aman :)");
                            }
                        });
                    });

                    // Proses tutup modal
                    $('#modal').on('hidden.bs.modal', function() {
                        clearInput(["nrp", "nama", "password", "foto_profil"]);
                        clearInvalidInput(["nrp", "nama", "password_lama", "password_baru", "password"]);

                        $(".div-image-preview")
                            .next(".div-password")
                            .remove();

                        // Meghilangkan data-id pada button
                        $('.btn-aksi').removeAttr("data-id");
                    });

                });
    </script>
    @endpush
</div>
@endsection