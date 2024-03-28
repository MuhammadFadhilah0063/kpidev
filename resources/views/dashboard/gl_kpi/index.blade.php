@extends('layouts.dashboard', ['pageTitle' => 'Data KPI Individu Group Leader ' . $subdivisi])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>KPI Individu Group Leader {{ $subdivisi }}</a></li>
@endsection

@push('button')
    <button class="btn btn-sm btn-primary fw-bold rounded" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modal">
        Tambah
    </button>
@endpush

@section('content')
    <div class="col-lg-12">

        <div class="card">
            @if (Auth::user()->kategori == 'MASTER')
                <div class="card-header">
                    <div class="row text-center text-sm-start">
                        <label for="filter_nama" class="pb-2 fw-bold">Filter Nama</label>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center justify-content-sm-start">
                            <select data-column="7" name="filter_nama" id="filter_nama" class="form-control select2"
                                style="max-width: 250px;">
                                <option value="">Pilih Filter</option>
                                @foreach ($users as $user)
                                    <option value="{{ ucfirst($user->nama) }}">
                                        {{ ucfirst($user->nama) }}
                                    </option>
                                @endforeach
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
                                <th class="text-center text-nowrap">Periode</th>
                                <th class="text-center text-nowrap">Point</th>
                                <th class="text-center text-nowrap">Aktual Realisasi</th>
                                <th class="text-center text-nowrap">Target</th>
                                <th class="text-center text-nowrap">Status</th>
                                <th class="text-center text-nowrap">Alasan</th>
                                <th class="text-center text-nowrap">nama</th>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KPI BARU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>User</label>
                                @if (Auth::user()->kategori == 'MASTER')
                                    <select name="id_user" id="id_user" class="form-control select3">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->nrp }} | {{ ucfirst($user->nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input class="form-control" type="hidden" name="id_user" id="id_user"
                                        value="{{ Auth::user()->id }}">
                                    <input class="form-control" type="text" readonly
                                        value="{{ Auth::user()->nrp }} | {{ ucfirst(Auth::user()->nama) }}">
                                @endif
                            </div>

                            <div class="form-group pt-3">
                                <label>Periode</label>
                                <select name="periode" id="periode" class="form-control select3">
                                    @foreach ($periodes as $periode)
                                        <option value="{{ $periode->periode }}">
                                            {{ ucfirst($periode->periode) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pt-3">
                                <label>Point</label>
                                <select name="id_kamus" id="id_kamus" class="form-control select3">
                                    <option value="">Pilih Point</option>
                                    @foreach ($kamuss as $kamus)
                                        <option value="{{ $kamus->id }}">
                                            {{ ucfirst($kamus->pointkpi) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pt-3">
                                <label>Target</label>
                                <input type="text" class="form-control" id="target" readonly>
                            </div>

                            <div class="form-group pt-3">
                                <label>Aktual Realisasi</label>
                                <input type="text" class="form-control" id="aktual_realisasi">
                            </div>

                            <div class="form-group pt-3">
                                <label>Subdivisi</label>
                                <input type="text" class="form-control" id="subdivisi" readonly
                                    value="{{ $subdivisi }}">
                            </div>

                            <div class="form-group pt-3">
                                <label>File</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    accept="image/*, application/pdf" onchange="selectPreview(this);">
                                <small class="fst-italic">
                                    Pilih file, jika ingin upload. File bisa image atau pdf.
                                </small>
                            </div>

                            {{-- Image Preview --}}
                            <div class="col-12 text-center pt-3 div-image-preview">
                                <img id="imagePreview" src="#" alt="Preview" class="img-fluid img-thumbnail"
                                    style="display:none; max-width: 100%; max-height: 300px; margin: 0 auto;">
                            </div>

                            {{-- PDF Preview --}}
                            <div class="col-12 text-center pt-3 div-pdf-preview">
                                <iframe style="display: none; margin: 0 auto;" id="pdfIframe" frameborder="0"
                                    height="400px" width="100%"></iframe>
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
                // Function memilih preview
                function selectPreview(input) {
                    var file = input.files[0];

                    if (file) {
                        if (file.type.startsWith('image/')) {
                            // Jika jenis file adalah gambar
                            imagePreview(file);
                        } else if (file.type === 'application/pdf') {
                            // Jika jenis file adalah PDF
                            pdfPreview(file);
                        }
                    }
                }

                // Function Image Preview
                function imagePreview(file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Tampilkan pratinjau gambar
                        document.getElementById('imagePreview').src = e.target.result;
                        document.getElementById('imagePreview').style.display = 'block';

                        // Sembunyikan pratinjau PDF
                        document.getElementById('pdfIframe').style.display = 'none';
                    };

                    // Baca file sebagai URL data
                    reader.readAsDataURL(file);
                }

                // Function PDF Preview
                function pdfPreview(file) {
                    // Dapatkan URL objek blob dari file PDF yang dipilih
                    var blobUrl = URL.createObjectURL(file);

                    // Atur sumber iframe ke URL objek blob
                    document.getElementById('pdfIframe').src = blobUrl;

                    // Tampilkan pratinjau PDF
                    document.getElementById('pdfIframe').style.display = 'block';

                    // Sembunyikan pratinjau gambar
                    document.getElementById('imagePreview').style.display = 'none';
                }

                $(document).ready(function() {

                    // Button add
                    $('#btnAdd').on("click", function(event) {
                        $('#exampleModalLabel').html("TAMBAH DATA BARU");
                        $('.btn-aksi').html("TAMBAH");
                    });

                    // Datatable
                    var dataTable = $('#tableData').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url()->current() }}",
                        'createdRow': function(row, data, dataIndex) {
                            $('td:eq(6)', row).css('min-width', '450px');
                        },
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
                                data: 'status',
                                render: function(data) {
                                    if (data == 'reject') {
                                        return `<button class="btn fw-bold btn-sm btn-danger">${ucfirst(data)}</button>`;
                                    } else {
                                        return `<button class="btn fw-bold btn-sm btn-warning">${ucfirst(data)}</button>`;
                                    }
                                }
                            },
                            {
                                data: 'alasan',
                                render: function(data) {
                                    if (data != null) {
                                        return data;
                                    } else {
                                        return "-";
                                    }
                                }
                            },
                            {
                                data: 'user.nama'
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
                                    return `<button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                        <i class="bi bi-pencil-square"></i></button>&nbsp;
                                        <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                        <i class="bi bi-trash"></i></button>`;
                                }
                            },
                        ],
                        columnDefs: [{
                                targets: [0, 1, 3, 4, 5, 7, 8, 9],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                            {
                                targets: [6],
                                className: "align-middle",
                            },
                            {
                                targets: [2],
                                className: "align-middle text-capitalize text-nowrap"
                            },
                        ]
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

                    // Proses tambah dan update
                    $(".btn-aksi").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        if ($(".btn-aksi").text() == "EDIT") {
                            // Hapus invalid
                            clearInvalidInput(["periode", "id_kamus", "aktual_realisasi", "file", "id_user"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["periode", "id_kamus", "aktual_realisasi", "subdivisi",
                                "id_user"
                            ]);

                            formData.append('_method', 'PUT');

                            // Ambil id
                            var id = $('.btn-aksi').attr("data-id");
                            var url = "{{ url()->current() }}/" + id;
                        } else if ($(".btn-aksi").text() == "TAMBAH") {
                            // Hapus invalid
                            clearInvalidInput(["nrp", "nama", "password", "id_kamus", "aktual_realisasi"]);

                            // Mengambil nilai dari input
                            var formData = getValueInput(["periode", "id_kamus", "aktual_realisasi", "subdivisi",
                                "id_user"
                            ]);
                            var url = "{{ url()->current() }}";
                        }

                        // Mengambil input file foto
                        var fileInput = document.getElementById("file");
                        var file = fileInput.files[0];

                        if (file) {
                            formData.append("file", file);
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
                        $('#exampleModalLabel').html("EDIT DATA");
                        $('.btn-aksi').html("EDIT");

                        // Menambahkan data-id pada button
                        $('.btn-aksi').attr("data-id", id);

                        $.ajax({
                            url: "{{ url()->current() }}/" + id + "/edit",
                            success: (response) => {
                                $("#modal").modal("show");

                                if (response.data) {
                                    @if (Auth::user()->kategori == 'MASTER')
                                        $('#id_user').val(response.data.id_user).trigger('change');
                                    @else
                                        $('#id_user').val(response.data.id_user);
                                    @endif

                                    $('#periode').val(response.data.periode).trigger('change');
                                    $('#id_kamus').val(response.data.id_kamus).trigger('change');
                                    $('#aktual_realisasi').val(response.data.aktual_realisasi);
                                    $('#subdivisi').val(response.data.subdivisi).trigger(
                                        'change');

                                    if (response.data.file) {
                                        var ekstensi = ((response.data.file).split('.'))[1];

                                        if (ekstensi != "pdf") {
                                            // Tampilkan pratinjau gambar
                                            document.getElementById('imagePreview').src =
                                                `{{ url('storage/file/${response.data.file}') }}`;
                                            document.getElementById('imagePreview').style.display =
                                                'block';
                                        } else {
                                            // Tampilkan pratinjau pdf
                                            document.getElementById('pdfIframe').src =
                                                `{{ url('storage/file/${response.data.file}') }}`;
                                            document.getElementById('pdfIframe').style.display =
                                                'block';
                                        }
                                    }
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
                        clearInput(["aktual_realisasi", "file"]);
                        clearInvalidInput(["aktual_realisasi", "file"]);

                        // Hapus pdf preview
                        var preview = $("#pdfIframe");

                        if (preview) {
                            preview.attr("src", "#");
                            preview.css("display", "none");
                        }

                        // Meghilangkan data-id pada button
                        $('.btn-aksi').removeAttr("data-id");
                    });

                    // Get Target
                    $('#id_kamus').change(function() {
                        var id_kamus = $(this).val();
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        if (id_kamus == "") {
                            id_kamus = null;
                        }

                        $.ajax({
                            url: "/get-kamus/" + id_kamus,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(data) {
                                $('#target').val(data.target + " " + data.unit_target);
                            },
                            error: function() {
                                console.error('Gagal mengambil data kompetensi.');
                            }
                        });
                    });

                });
            </script>
        @endpush
    </div>
@endsection
