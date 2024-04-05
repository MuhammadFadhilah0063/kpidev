@extends('layouts.dashboard', ['pageTitle' => 'Data Kamus General'])

@section('breadcrumb')
<li class="breadcrumb-item active"><a>Kamus General</a></li>
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
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row">
                @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                <div style="min-width: 120px" class="flex-column flex-sm-row mx-auto mx-sm-0">
                    <div class="my-0 text-center text-sm-start">
                        <label for="filter_subdivisi" class="pb-2 fw-bold">Filter Sub Divisi</label>
                    </div>
                    <select data-column="2" name="filter_subdivisi" id="filter_subdivisi" class="form-control select2"
                        style="max-width: 120px;">
                        <option value="">Pilih Filter</option>
                        <option value="COMBEN">COMBEN</option>
                        <option value="REKRUT">REKRUT</option>
                        <option value="TND">TND</option>
                        <option value="IR">IR</option>
                        <option value="ALL">ALL</option>
                    </select>
                </div>
                @endif

                <div style="min-width: 200px" class="ps-0 ps-sm-3 pt-3 pt-sm-0 flex-column flex-sm-row mx-auto mx-sm-0">
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

        <div class="card-body">
            <div class="table-responsive pt-3">
                <!-- Table with stripped rows -->
                <table class="table table-striped table-hover table-bordered" id="tableData">
                    <thead class="table-danger">
                        <tr>
                            <th class="text-center text-nowrap">No.</th>
                            <th class="text-center text-nowrap">Area Kinerja Utama</th>
                            <th class="text-center text-nowrap">Subdivisi</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Baris</th>
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
    </div>
</div>

{{-- Modal Tambah dan Edit --}}
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KAMUS BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label class="pb-1">Subdivisi</label>
                                <select class="form-control select3" name="subdivisi" id="subdivisi">
                                    <option value="COMBEN">COMBEN</option>
                                    <option value="REKRUT">REKRUT</option>
                                    <option value="TND">TND</option>
                                    <option value="IR">IR</option>
                                    <option value="ALL">ALL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="pb-1">Kategori</label>
                                <select class="form-control select3" name="kategori" id="kategori">
                                    <option value="GROUP LEADER">GROUP LEADER</option>
                                    <option value="ADMIN">ADMIN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row-target">
                        <label class="pt-3 pb-1">Area Kinerja Utama</label>
                        <input type="text" name="area_kinerja_utama" id="area_kinerja_utama" class="form-control"
                            required placeholder="Area Kinerja Utama">
                    </div>

                    <div class="box-container">
                        <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="pb-1">Key Performance Indicators 1</label>
                                <textarea required class="form-control" name="key_performance_indicators" cols="30"
                                    rows="4"></textarea>
                                <small class="fst-italic">
                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat.
                                    <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                        title="Contoh pengisian!"
                                        class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                        <i class="bi bi-info-lg"></i>
                                    </a>
                                </small>
                            </div>

                            <div class="form-group">
                                <label class="pt-3 pb-1">Bobot</label>
                                <input type="number" name="bobot" class="form-control" required placeholder="0">
                            </div>

                            <div class="form-group">
                                <label class="pt-3 pb-1">Target</label>
                                <textarea required class="form-control" name="target" cols="30" rows="4"></textarea>
                                <small class="fst-italic">
                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat.
                                    <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                        title="Contoh pengisian!"
                                        class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                        <i class="bi bi-info-lg"></i>
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col text-center pt-3">
                            <button type="button" class="btn btn-sm btn-primary btn-add-indicator">
                                + Key Performance
                                Indicators
                            </button>
                        </div>
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
    $(document).ready(function() {

                // Button add new indicator
                $('.btn-add-indicator').on("click", function(event) {
                    var jumlahBoxItem = $(".box-container .box-item").length;
                    var template =
                        `<div data-boxid="${jumlahBoxItem + 1}" class="box-item border rounded p-2 mt-3">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <div class="pb-1 row d-flex justify-content-between">
                                    <div class="col m-auto">
                                        Key Performance Indicators ${jumlahBoxItem + 1}
                                    </div>
                                    <div class="col-2 text-end">
                                        <button type="button"
                                            class="px-1 py-0 fw-bold m-auto btn btn-sm btn-danger btn-remove-indicator">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <textarea required class="form-control" name="key_performance_indicators" cols="30" rows="4"></textarea>
                                <small class="fst-italic">
                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat. <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                                title="Contoh pengisian!"
                                                class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                </small>
                            </div>

                            <div class="form-group">
                                <label class="pt-3 pb-1">Bobot</label>
                                <input type="number" name="bobot" class="form-control" required placeholder="0">
                            </div>

                            <div class="form-group row-target">
                                <label class="pt-3 pb-1">Target</label>
                                <textarea required class="form-control" name="target" cols="30" rows="4"></textarea>
                                <small class="fst-italic">
                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat. <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                                title="Contoh pengisian!"
                                                class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                </small>
                            </div>
                        </div>`;

                    $(".box-container").append(template);
                });

                // Button remove indicator
                $(document).on('click', '.btn-remove-indicator', function() {
                    var boxItem = $(this).closest(".box-item");
                    boxItem.remove();
                });

                // Button add
                $('#btnAdd').on("click", function(event) {
                    $('#exampleModalLabel').html("TAMBAH KAMUS BARU");
                    $('.btn-aksi').html("TAMBAH");
                    $('.control-baris').remove();
                });

                // Proses tambah dan update
                $(".btn-aksi").on("click", function(event) {
                    // Tampil loading
                    $(".load").removeClass("d-none");

                    // Hapus invalid
                    clearInvalidInput(["area_kinerja_utama"]);

                    // Mengambil nilai dari input
                    var formData = getValueInput(["area_kinerja_utama", "subdivisi", "baris", "kategori"]);
                    var jumlahBoxItem = $(".box-container .box-item").length;
                    for (let i = 0; i < jumlahBoxItem; i++) {
                        formData.append(`${i}[key_performance_indicators]`, $(
                                `[data-boxid="${i + 1}"] textarea[name="key_performance_indicators"]`)
                            .val());
                        formData.append(`${i}[bobot]`, $(
                            `[data-boxid="${i + 1}"] input[name="bobot"]`).val());
                        formData.append(`${i}[target]`, $(
                            `[data-boxid="${i + 1}"] textarea[name="target"]`).val());
                        formData.append(`${i}[id]`, $(
                            `[data-boxid="${i + 1}"] input[name="id"]`).val());
                    }

                    if ($(".btn-aksi").text() == "EDIT") {

                        formData.append('_method', 'PUT');

                        // Ambil id
                        var id = $('.btn-aksi').attr("data-id");
                        var url = "kamus-general/" + id;
                    } else if ($(".btn-aksi").text() == "TAMBAH") {

                        var url = "kamus-general";
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
                            $(".load").addClass("d-none");

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

                    // Menampilkan input baris
                    $('.row-target').append(`<div class="form-group control-baris">
                                                    <label class="pt-3 pb-1">Baris</label>
                                                    <input type="number" name="baris" id="baris" class="form-control"
                                                        placeholder="baris">
                                                </div>`);

                    // Menambahkan data-id pada button
                    $('.btn-aksi').attr("data-id", id);

                    $.ajax({
                        url: "kamus-general/" + id + "/edit",
                        success: (response) => {
                            $("#modal").modal("show");

                            if (response.kamus) {
                                $('#area_kinerja_utama').val(response.kamus.area_kinerja_utama);
                                $('#subdivisi').val(response.kamus.subdivisi).trigger('change');
                                $('#kategori').val(response.kamus.kategori).trigger('change');
                                $('#baris').val(response.kamus.baris);

                                // Tampilkan data item
                                var items = response.kamus.indicator_items;
                                for (let i = 0; i < items.length; i++) {
                                    var template =
                                        `<div data-boxid="${i + 1}" class="box-item border rounded p-2 mt-3">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <div class="pb-1 row d-flex justify-content-between">
                                                    <div class="col m-auto">
                                                        Key Performance Indicators ${i + 1}
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <button type="button"
                                                            class="px-1 py-0 fw-bold m-auto btn btn-sm btn-danger btn-remove-indicator">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <textarea required class="form-control" name="key_performance_indicators" cols="30" rows="4"></textarea>
                                                <small class="fst-italic">
                                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat. <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                                title="Contoh pengisian!"
                                                class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Bobot</label>
                                                <input type="number" name="bobot" class="form-control" required placeholder="0">
                                            </div>

                                            <div class="form-group row-target">
                                                <label class="pt-3 pb-1">Target</label>
                                                <textarea required class="form-control" name="target" cols="30" rows="4"></textarea>
                                                <small class="fst-italic">
                                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir kalimat. <a href="{{ asset('assets/images/input.png') }}" target="_blank"
                                                title="Contoh pengisian!"
                                                class="btn btn-sm btn-outline-danger p-0 px-1 rounded-4 fw-bold">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                                </small>
                                            </div>
                                        </div>`;


                                    if (i != 0) {
                                        $(".box-container").append(template);
                                    }

                                    $(`[data-boxid="${i + 1}"] textarea[name="key_performance_indicators"]`)
                                        .val(items[i].indicator);
                                    $(`[data-boxid="${i + 1}"] input[name="bobot"]`).val(items[i]
                                        .bobot);
                                    $(`[data-boxid="${i + 1}"] textarea[name="target"]`).val(items[
                                            i]
                                        .target);
                                    $(`[data-boxid="${i + 1}"] input[name="id"]`).val(items[
                                            i]
                                        .id);
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
                                url: "kamus-general/" + id,
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
                            data: 'area_kinerja_utama'
                        },
                        {
                            data: 'subdivisi'
                        },
                        {
                            data: 'kategori'
                        },
                        {
                            data: 'baris',
                            render: function(data, type, row, meta) {
                                if (data) {
                                    return data;
                                } else {
                                    return "-";
                                }
                            }
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
                            targets: [2, 3, 4],
                            className: "text-center align-middle text-capitalize text-nowrap"
                        },
                        {
                            targets: [1],
                            className: "align-middle text-capitalize text-nowrap"
                        },
                        @if (Auth::user()->kategori == 'MASTER')
                            {
                                targets: [5],
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

                // Proses tutup modal
                $('#modal').on('hidden.bs.modal', function() {
                    clearInput(["area_kinerja_utama"]);
                    $('textarea[name="key_performance_indicators"]').val('');
                    $('textarea[name="target"]').val('');
                    $('input[name="bobot"]').val('');

                    // Mengambil semua elemen .box-item di dalam .box-container
                    var semuaBoxItem = $(".box-container .box-item");

                    // Mengambil jumlah elemen .box-item
                    var jumlahBoxItem = semuaBoxItem.length;

                    // Menyaring elemen-elemen kecuali yang pertama
                    var boxItemYangDibiarkan = semuaBoxItem.not(":first");

                    // Menghapus elemen-elemen yang tidak disaring
                    boxItemYangDibiarkan.remove();

                    clearInvalidInput(["area_kinerja_utama"]);

                    // Meghilangkan data-id pada button
                    $('.btn-aksi').removeAttr("data-id");

                    // Menghilangkan baris
                    $('.control-baris').remove();
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