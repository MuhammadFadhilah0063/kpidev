@extends('layouts.dashboard', ['pageTitle' => 'Data KPI General Admin ' . $subdivisi])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>KPI General Admin {{ $subdivisi }}</a></li>
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
                            <select data-column="2" name="filter_nama" id="filter_nama" class="form-control select2"
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
                                <th class="text-center text-nowrap">nama</th>
                                <th class="text-center text-nowrap">Status</th>
                                <th class="text-center text-nowrap">Alasan</th>
                                <th class="text-center text-nowrap">KPI</th>
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
                    <div class="modal-body">
                        {{-- Tabs Item --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($kamuss as $index => $kamus)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-danger @if ($index == 0) active @endif"
                                        id="tab-{{ $index }}" data-bs-toggle="tab"
                                        data-bs-target="#tab-pane-{{ $index }}" type="button" role="tab">
                                        {{ $index + 1 }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content" id="myTabContent">
                            @foreach ($kamuss as $index_kamus => $kamus)
                                <div class="tab-pane fade @if ($index_kamus == 0) show active @endif"
                                    id="tab-pane-{{ $index_kamus }}" role="tabpanel" tabindex="{{ $index_kamus }}">
                                    @if ($index_kamus == 0)
                                        <div class="form-group pt-3">
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
                                            <label>File</label>
                                            <input type="file" name="file" id="file" class="form-control"
                                                accept="image/*, application/pdf" onchange="selectPreview(this);">
                                            <small class="fst-italic">
                                                Pilih file, jika ingin upload. File bisa image atau pdf.
                                            </small>
                                        </div>

                                        {{-- Image Preview --}}
                                        <div class="col-12 text-center pt-3 div-image-preview">
                                            <img id="imagePreview" src="#" alt="Preview"
                                                class="img-fluid img-thumbnail"
                                                style="display:none; max-width: 100%; max-height: 300px; margin: 0 auto;">
                                        </div>

                                        {{-- PDF Preview --}}
                                        <div class="col-12 text-center pt-3 div-pdf-preview img-thumbnail"
                                            style="display: none;">
                                            <iframe style="margin: 0 auto;" id="pdfIframe" frameborder="0" height="400px"
                                                width="100%"></iframe>
                                        </div>

                                        <hr class="mb-0">
                                    @endif

                                    <div class="form-group">
                                        <label class="pt-3 pb-1">Area Kinerja Utama</label>
                                        <input readonly type="text" class="form-control"
                                            value="{{ $kamus->area_kinerja_utama }}">
                                    </div>

                                    <input type="hidden" name="id_kamus_general" value="{{ $kamus->id }}">

                                    @foreach ($kamus->indicator_items as $index => $item)
                                        <div class="box-container">
                                            <div data-boxid="{{ $index + 1 }}"
                                                class="box-item border rounded p-2 mt-3">
                                                <input type="hidden" name="id_key_indicator"
                                                    value="{{ $item->id }}">
                                                <input type="hidden" name="id_item">
                                                <div class="text-center">
                                                    Key Performance Indicator {{ $index + 1 }}
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label class="pb-1">Bobot</label>
                                                    <input readonly name="bobot" type="text" class="form-control"
                                                        value="{{ $item->bobot }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Key Performance Indicator</label>
                                                    <textarea readonly class="form-control" cols="30" rows="4">{{ Str::replace('@', '', $item->indicator) }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Target</label>
                                                    <textarea readonly class="form-control" cols="30" rows="4">{{ Str::replace('@', '', $item->target) }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Realisasi</label>
                                                    <textarea required class="form-control" name="realisasi" cols="30" rows="4"></textarea>
                                                    <small class="fst-italic">
                                                        Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada
                                                        akhir
                                                        kalimat.
                                                    </small>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Skor</label>
                                                    <input type="number" name="skor" class="form-control" required
                                                        placeholder="skor">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if (count($kamuss) - 1 == $index_kamus)
                                        <div class="row text-center pt-4">
                                            <div class="col">
                                                <button type="button" class="btn btn-primary btn-aksi fw-bold"
                                                    data-count="{{ count($kamuss) }}">TAMBAH</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>
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
                        document.getElementById('pdfIframe').parentNode.style.display = 'none';
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
                    document.getElementById('pdfIframe').parentNode.style.display = 'block';

                    // Sembunyikan pratinjau gambar
                    document.getElementById('imagePreview').style.display = 'none';
                }

                $(document).ready(function() {

                    // Button add
                    $('#btnAdd').on("click", function(event) {
                        $('#exampleModalLabel').html("TAMBAH KPI GENERAL BARU");
                        $('.btn-aksi').html("TAMBAH");
                    });

                    // Datatable
                    var dataTable = $('#tableData').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url()->current() }}",
                        'createdRow': function(row, data, dataIndex) {
                            $('td:eq(4)', row).css('min-width', '300px');
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
                                data: 'user.nama'
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
                                data: 'id',
                                render: function(data) {
                                    return `<a href="{{ url('admin-general/${data}/pdf') }}"
                                                target="_blank" class="btn fw-bold btn-sm btn-info">
                                                <i class="bi bi-filetype-pdf"></i>
                                            </a>`;
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
                                targets: [0, 1, 3, 5, 6],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                            {
                                targets: [2, 4],
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

                        // Ambil text dari button aksi
                        textBtn = $(".btn-aksi").text();

                        Swal.fire({
                            title: "YAKIN " + textBtn + "?",
                            text: "Pastikan input terisi semua, jika ada salah satu yang kosong maka proses akan gagal!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "YA, " + textBtn + "!",
                            cancelButtonText: "TIDAK, BATAL!",
                            reverseButtons: true,
                            confirmButtonColor: "rgba(220, 20, 60, 0.879)",
                        }).then((result) => {
                            if (result.isConfirmed) {

                                // Tampil loading
                                $(".load").removeClass("d-none");

                                // Ambil data dari input tiap tab nya dan buat ke formdata
                                var count = $('.btn-aksi').attr("data-count");
                                var formData = new FormData();

                                for (let i = 0; i < count; i++) {
                                    formData.append(`${i}[id_kamus_general]`, $(
                                        `#tab-pane-${i} input[name="id_kamus_general"]`).val());
                                    formData.append(`${i}[no_urut]`, i + 1);

                                    var jumlahBoxItem = $(`#tab-pane-${i} .box-container .box-item`).length;
                                    for (let k = 0; k < jumlahBoxItem; k++) {
                                        formData.append(
                                            `${i}[key_performance_indicators][${k}][id_key_performance_indicator]`,
                                            $(
                                                `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="id_key_indicator"]`
                                            ).val());
                                        formData.append(
                                            `${i}[key_performance_indicators][${k}][id]`,
                                            $(
                                                `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="id_item"]`
                                            ).val());
                                        formData.append(`${i}[key_performance_indicators][${k}][skor]`, $(
                                            `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="skor"]`
                                        ).val());
                                        formData.append(`${i}[key_performance_indicators][${k}][realisasi]`,
                                            $(
                                                `#tab-pane-${i} [data-boxid="${k + 1}"] textarea[name="realisasi"]`
                                            ).val());
                                        formData.append(`${i}[key_performance_indicators][${k}][bobot]`, $(
                                                `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="bobot"]`
                                            )
                                            .val());
                                    }
                                }

                                formData.append("id_user", $("#id_user").val());
                                formData.append("periode", $("#periode").val());

                                // Mengambil input file foto
                                var fileInput = document.getElementById("file");
                                var file = fileInput.files[0];

                                if (file) {
                                    formData.append("file", file);
                                }

                                if (textBtn == "EDIT") {

                                    formData.append('_method', 'PUT');
                                    // Ambil id
                                    var id = $('.btn-aksi').attr("data-id");
                                    var url = "{{ url()->current() }}/" + id;
                                } else if (textBtn == "TAMBAH") {
                                    var url = "{{ url()->current() }}";
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
                                showAlert('error', textBtn + " DIBATALKAN!");
                            }
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
                                            document.getElementById('pdfIframe').parentNode.style
                                                .display = 'block';
                                        }
                                    }

                                    // Tampilkan data
                                    var items = response.data.items;
                                    var itemsLength = Object.keys(response.data.items).length;

                                    for (let k = 0; k < itemsLength; k++) {
                                        for (let i = 0; i < items[k + 1].length; i++) {
                                            $(`#tab-pane-${k} [data-boxid="${i + 1}"] input[name="id_key_indicator"]`)
                                                .val(items[k + 1][i].id_key_performance_indicator);
                                            $(`#tab-pane-${k} [data-boxid="${i + 1}"] input[name="id_item"]`)
                                                .val(items[k + 1][i].id);
                                            $(`#tab-pane-${k} [data-boxid="${i + 1}"] input[name="skor"]`)
                                                .val(items[k + 1][i].skor);
                                            $(`#tab-pane-${k} [data-boxid="${i + 1}"] textarea[name="realisasi"]`)
                                                .val(items[k + 1][i].realisasi);
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

                        $(`textarea[name="realisasi"]`).val('');
                        $(`input[name="skor"]`).val('');
                        $(`input[name="konversi_sf"]`).val('');
                        $(`input[name="file"]`).val('');

                        // Hapus pdf preview
                        var preview = $("#pdfIframe");
                        var previewImg = $("#imagePreview");

                        if (preview.length) {
                            preview.parent().attr("src", "#");
                            preview.parent().css("display", "none");
                        }

                        if (previewImg.length) {
                            previewImg.attr("src", "#");
                            previewImg.css("display", "none");
                        }

                        // Meghilangkan data-id pada button
                        $('.btn-aksi').removeAttr("data-id");
                    });

                });
            </script>
        @endpush
    </div>
@endsection
