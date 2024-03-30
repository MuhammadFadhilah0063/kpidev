@extends('layouts.dashboard', ['pageTitle' => 'Data KPI General Section'])

@section('breadcrumb')
<li class="breadcrumb-item active"><a>KPI General Section</a></li>
@endsection

@push('button')
<button class="btn btn-sm btn-primary fw-bold rounded" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modal">
    Tambah
</button>
@endpush

@section('content')
<div class="col-lg-12 content">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive pt-3">
                <!-- Table with stripped rows -->
                <table class="table table-striped table-hover table-bordered" id="tableData">
                    <thead class="table-danger">
                        <tr>
                            <th class="text-center text-nowrap">No.</th>
                            <th class="text-center text-nowrap">Tanggal Input</th>
                            <th class="text-center text-nowrap">Tahun</th>
                            <th class="text-center text-nowrap">KPI</th>
                            <th class="text-center text-nowrap">file</th>
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
    <div class="modal fade" id="modal" aria-hidden="true" aria-labelledby="modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KPI BARU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun">
                    </div>

                    <div class="form-group pt-3">
                        <label>Parameter</label>
                        <textarea class="form-control" name="parameter" id="parameter" cols="30" rows="6"></textarea>
                        <small class="fst-italic">
                            Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir
                            kalimat.
                        </small>
                    </div>

                    <div class="form-group pt-3">
                        <label>File</label>
                        <input type="file" name="file" id="file" class="form-control" accept="image/*, application/pdf"
                            onchange="selectPreview(this);">
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
                        <iframe style="display: none; margin: 0 auto;" id="pdfIframe" frameborder="0" height="400px"
                            width="100%"></iframe>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-primary fw-bold" data-bs-target="#modal2" data-bs-toggle="modal">
                        Lanjut
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal 2 --}}
    <div class="modal fade" id="modal2" aria-hidden="true" aria-labelledby="modal2Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KPI BARU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="main">
                        {{-- Tabs Item --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-danger active" id="tab-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-pane-1" type="button" role="tab">
                                    1
                                </button>
                            </li>
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-pane-1" role="tabpanel" tabindex="1">

                                <div class="form-group pt-3">
                                    <label class="pb-1">BSC Category 1</label>
                                    <input type="text" name="bsc_category" class="form-control" id="bsc_category">
                                </div>

                                <div class="box-container">
                                    <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                        <input type="hidden" name="id">

                                        <div class="text-center">
                                            Goal 1
                                        </div>
                                        <hr style="margin-top: 8px;">

                                        <div class="form-group">
                                            <label class="pb-1">Point</label>
                                            <select name="id_kamus" id="id_kamus" class="form-select select3">
                                                <option value="">Pilih Point</option>
                                                @foreach ($kamuss as $kamus)
                                                <option value="{{ $kamus->id }}">
                                                    {{ ucfirst($kamus->area_kinerja_utama) }} ({{ ($kamus->subdivisi ==
                                                    "ALL") ? "ALL TEAM" : $kamus->subdivisi }} @if($kamus->subdivisi !=
                                                    "ALL") -
                                                    Point {{ $kamus->baris }} @endif)</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Goal Name</label>
                                            <input type="text" name="goal_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Description</label>
                                            <textarea required class="form-control" name="metric_description" cols="30"
                                                rows="5"></textarea>
                                            <small class="fst-italic">
                                                Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada
                                                akhir
                                                kalimat.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Scale</label>
                                            <textarea required class="form-control" name="metric_scale" cols="30"
                                                rows="6"></textarea>
                                            <small class="fst-italic">
                                                Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada
                                                akhir
                                                kalimat.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Weight</label>
                                            <input type="number" name="weight" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Nilai Pencapaian SF (KPI GENERAL)</label>
                                            <input type="text" name="nilai_pencapaian_sf" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm fw-bold btn-primary btn-add-indicator">
                                            + Goal
                                        </button>
                                        <button type="button" class="btn btn-sm fw-bold btn-info  btn-add-category">
                                            + BSC Category
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn fw-bold btn-warning" data-bs-target="#modal" data-bs-toggle="modal">
                        Kembali
                    </button>
                    <button class="btn-aksi btn fw-bold btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {           

            // Button add
            $('#btnAdd').on("click", function (event) {

                $('#exampleModalLabel').html("TAMBAH KPI GENERAL BARU");
                $('.btn-aksi').html("Simpan");

                // Refresh Modal
                refreshModal()
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
                    render: function (data, type, row, meta) {
                    return new Intl.NumberFormat('id-ID').format(meta.row + meta.settings
                        ._iDisplayStart + 1);
                    }
                },
                {
                    data: 'created_at',
                    render: function (data) {
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
                    data: 'tahun'
                },
                {
                    data: 'id',
                    render: function (data) {
                    return `<a href="{{ url('section-kpi-general/${data}/pdf') }}" target="_blank" class="btn fw-bold btn-sm btn-info">
                                    <i class="bi bi-filetype-pdf"></i>
                                </a>`;
                    }
                },
                {
                    data: 'file',
                    render: function (data) {
                    if (data != null) {
                        return `<a href="{{ asset('storage/file/${data}') }}" target="_blank" class="btn fw-bold btn-sm btn-secondary">
                                    <i class="bi bi-search"></i>
                                </a>`;
                    } else {
                        return "-";
                    }
                    }
                },
                {
                    data: 'id',
                    render: function (data) {
                    return `<button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                    <i class="bi bi-pencil-square"></i></button>&nbsp;
                                <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                    <i class="bi bi-trash"></i></button>`;
                    }
                },
                ],
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5],
                    className: "text-center align-middle text-capitalize text-nowrap"
                }]
            });

            function simpanOrUpdate() {
                // Ambil text dari button aksi
                textBtn = $(".btn-aksi").text();

                Swal.fire({
                    title: "Yakin ?",
                    text: "Pastikan input terisi semua, jika ada salah satu yang kosong maka proses akan gagal!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, " + textBtn + "!",
                    cancelButtonText: "Tidak, Batal!",
                    reverseButtons: true,
                    confirmButtonColor: "rgba(220, 20, 60, 0.879)",
                }).then((result) => {
                    if (result.isConfirmed) {

                    // Tampil loading
                    $(".load").removeClass("d-none");

                    // Ambil data dari input tiap tab nya dan buat ke formdata
                    var count = $('.btn-aksi').attr("data-count");
                    var formData = new FormData();

                    formData.append("tahun", $('input[name="tahun"]').val());
                    formData.append("parameter", $('textarea[name="parameter"]').val());

                    // Mengambil input file foto
                    var fileInput = document.getElementById("file");
                    var file = fileInput.files[0];

                    if (file) {
                        formData.append("file", file);
                    }

                    // Input Category dan Goal
                    var countTab = $(".tab-pane").length;

                    for (let i = 1; i < countTab + 1; i++) {

                        var jumlahBoxItem = $(`#tab-pane-${i} .box-container .box-item`).length;
                        var goals = [];

                        for (let k = 0; k < jumlahBoxItem; k++) {
                        goals.push([
                            `"` + $(
                            `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="goal_name"]`)
                            .val() + `"`,
                            `"` + $(
                            `#tab-pane-${i} [data-boxid="${k + 1}"] textarea[name="metric_description"]`)
                            .val() + `"`,
                            `"` + $(
                            `#tab-pane-${i} [data-boxid="${k + 1}"] textarea[name="metric_scale"]`)
                            .val() + `"`,
                            `"` + $(
                            `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="weight"]`)
                            .val() + `"`,
                            `"` + $(
                            `#tab-pane-${i} [data-boxid="${k + 1}"] input[name="nilai_pencapaian_sf"]`)
                            .val() + `"`,
                        ]);
                        }

                        var category = [
                            `"` + $(`#tab-pane-${i} input[name="bsc_category"]`).val() + `"`,
                            goals,
                        ];

                        formData.append(`bsc_categories[]`, category);
                    }

                    // Tentukan url update atau store
                    if (textBtn == "Edit") {
                        formData.append('_method', 'PUT');
                        // Ambil id
                        var id = $('.btn-aksi').attr("data-id");
                        var url = "{{ url()->current() }}/" + id;
                    } else if (textBtn == "Simpan") {
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
                        success: function (response) {

                            if (response.status == "success") {

                                // Alert
                                showAlert('success', response.message);

                                // Tutup modal
                                $("#modal").modal("hide");
                                $("#modal2").modal("hide");

                                // reload table
                                dataTable.ajax.reload();

                                // Refresh Modal
                                refreshModal()
                            } else {
                                // Alert
                                showAlert('error', response.message);
                            }
                        },
                        error: function (error) {
                            // Alert
                            showAlert('error', "Error sistem");
                        }
                    }).always(function () {
                        // Hilangkan loading
                        $(".load").addClass("d-none");
                    });

                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Alert
                        showAlert('error', textBtn + " Dibatalkan!");
                    }
                });
            }

            // Proses tambah dan update
            $(".btn-aksi").on("click", function (event) {
                simpanOrUpdate();
            });

            // Proses edit
            $(document).on('click', '.btnEdit', function () {

                // Tampil loading
                $(".load").removeClass("d-none");

                // Refresh Modal
                refreshModal()

                var id = $(this).data('id');
                $('#exampleModalLabel').html("EDIT DATA");
                $('.btn-aksi').html("Edit");

                // Menambahkan data-id pada button
                $('.btn-aksi').attr("data-id", id);

                $.ajax({
                    url: "{{ url()->current() }}/" + id + "/edit",
                    success: (response) => {
                    $("#modal").modal("show");

                    if (response.data) {

                        $('input[name="tahun"]').val(response.data.tahun);
                        $('textarea[name="parameter"]').val(response.data.parameter);

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

                        // Ambil data category dan goal
                        var category_items = response.data.category_items;
                        var categoryLength = category_items.length;

                        // Loop add new tab category
                        for (let i = 1; i < categoryLength; i++) {
                        addNewTab();
                        }

                        // Loop add new goal on new tab
                        category_items.forEach(function (category, index) {

                            // Isi data bsc_category
                            $(`#tab-pane-${index + 1} input[name="bsc_category"]`)
                                .val(category.bsc_category);

                            var goal_length = category['goal_items'].length;
                            if (goal_length > 1) {

                                var selisih = goal_length - 1;
                                var noBox = 1;
                                for (let i = 0; i < selisih; i++) {

                                    var template =
                                        `<div data-boxid="${noBox + 1}" class="box-item border rounded p-2 mt-3">
                                            <input type="hidden" name="id">
                                            <div class="text-center position-relative py-2">
                                                <span class="position-absolute start-55 translate-middle" style="margin-top: 2px;">Goal ${noBox + 1}</span>
                                                <button type="button" class="px-1 py-0 fw-bold btn btn-sm btn-danger btn-remove-indicator position-absolute end-0 top-0">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                            <hr style="margin-top: 12px;">

                                            <div class="form-group">
                                                <label class="pb-1">Point</label>
                                                <select name="id_kamus" id="id_kamus" class="form-select select3">
                                                    <option value="">Pilih Point</option>
                                                    @foreach ($kamuss as $kamus)
                                                        <option value="{{ $kamus->id }}">
                                                            {{ ucfirst($kamus->area_kinerja_utama) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Goal Name</label>
                                                <input type="text" name="goal_name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Metric Description</label>
                                                <textarea required class="form-control" name="metric_description" cols="30" rows="4"></textarea>
                                                <small class="fst-italic">
                                                    Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir
                                                    kalimat.
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Metric Scale</label>
                                                <textarea required class="form-control" name="metric_scale" cols="30" rows="6"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Weight</label>
                                                <input type="number" name="weight" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="pt-3 pb-1">Nilai Pencapaian SF (KPI GENERAL)</label>
                                                <input type="text" name="nilai_pencapaian_sf" class="form-control">
                                            </div>
                                        </div>
                                        `;

                                    $("#tab-pane-" + (index + 1) + " .box-container").append(template);
                                    noBox++;
                                }
                            }
                        });

                        // Isi data goal
                        category_items.forEach(function (category, index) {

                        var goals = category['goal_items'];
                        goals.forEach(function (goal, no) {

                            $(`#tab-pane-${index + 1} div[data-boxid="${no + 1}"] input[name="goal_name"]`)
                            .val(goal.goal_name);
                            $(`#tab-pane-${index + 1} div[data-boxid="${no + 1}"] textarea[name="metric_description"]`)
                            .val(goal.metric_description);
                            $(`#tab-pane-${index + 1} div[data-boxid="${no + 1}"] textarea[name="metric_scale"]`)
                            .val(goal.metric_scale);
                            $(`#tab-pane-${index + 1} div[data-boxid="${no + 1}"] input[name="weight"]`)
                            .val(goal.weight);
                            $(`#tab-pane-${index + 1} div[data-boxid="${no + 1}"] input[name="nilai_pencapaian_sf"]`)
                            .val(goal.nilai_pencapaian_sf);
                        });
                        });
                    }
                    }
                });

                // Hilangkan loading
                $(".load").addClass("d-none");
            });

            // Proses delete
            $(document).on('click', '.btnHapus', function () {

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
                        success: function (response) {

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
                        error: function (error) {
                        // Alert
                        showAlert('error', "Error sistem");
                        }
                    }).always(function () {
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

            // Button add new goal
            $(document).on('click', '.btn-add-indicator', function () {

                // Buat template box goal
                var generate = generateTemplateBoxGoal()

                $("#" + generate[0] + " .box-container").append(generate[1]);
                });

                // Button remove goal
                $(document).on('click', '.btn-remove-indicator', function () {
                var boxItem = $(this).closest(".box-item");
                boxItem.remove();
                });

                // Button remove category
                $(document).on('click', '.btn-remove-category', function () {
                var dataid = $(this).attr("data-id");
                var btntab = $("button#tab-" + dataid);
                var navitem = btntab.closest("li.nav-item");
                var tabpane = $(this).closest("div.tab-pane");

                // Remove Tab Item dan Tab Content
                tabpane.remove();
                navitem.remove();
            });

            // Button add new category
            $(document).on('click', '.btn-add-category', function (event) {

                // Bikin tab baru
                var newTabId = addNewTab();

                // Alihkan ke tab yang baru saja dibuat
                $(`#${newTabId}`).tab('show');
            });

            // Get kamus
            $(document).on('change', 'select[name="id_kamus"]', function () {
                var boxcontainer = $(this).parent().parent();
                var id_kamus = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (id_kamus == "") {
                    id_kamus = null;
                }

                $.ajax({
                    url: "/get-kamus-general/" + id_kamus,
                    type: 'GET',
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (data) {
                        boxcontainer.find('input[name="goal_name"]').val(data
                            .area_kinerja_utama);

                        var combinedIndicator =
                            ''; // Inisialisasi string yang akan menyimpan semua indicator

                        // Perulangan untuk setiap objek dalam array indicator_items
                        data.indicator_items.forEach(function (item) {
                            // Menggabungkan nilai indicator dari setiap objek dan menambahkan pemisah
                            combinedIndicator += item.indicator + '@\n\n@';
                        });

                        // Menghapus karakter pemisah tambahan di akhir string
                        combinedIndicator = combinedIndicator.slice(0, -3);

                        boxcontainer.find('textarea[name="metric_scale"]').val(
                            combinedIndicator);
                        boxcontainer.find('input[name="weight"]').val(data.indicator_items[0]
                            .bobot);

                        var sf = (data.subdivisi == "ALL") ? "ALL TEAM" : `${data.subdivisi} (POINT ${data.baris})`;
                        boxcontainer.find('input[name="nilai_pencapaian_sf"]').val(sf);
                    },
                    error: function () {
                    console.error('Gagal mengambil data kompetensi.');
                    }
                });
            });
        });

            function addNewTab() {
                var jumlahBoxItem = $(".nav-tabs .nav-item").length;

                var newTabId = `tab-${jumlahBoxItem + 1}`;
                var newTabPaneId = `tab-pane-${jumlahBoxItem + 1}`;

                var templateTabItem =
                `<li class="nav-item" role="presentation">
                                            <button class="nav-link text-danger" id="${newTabId}" data-bs-toggle="tab"
                                                data-bs-target="#${newTabPaneId}" type="button" role="tab">
                                                ${jumlahBoxItem + 1}
                                            </button>
                                        </li>`;

                var templateTabContent =
                `<div class="tab-pane fade" id="tab-pane-${jumlahBoxItem + 1}" role="tabpanel" tabindex="${jumlahBoxItem + 1}">
                                        <div class="form-group pt-3">
                                            <label class="pb-1">BSC Category ${jumlahBoxItem + 1}</label>
                                            <input type="text" class="form-control" id="bsc_category" name="bsc_category">
                                        </div>

                                        <div class="box-container">
                                            <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                                <input type="hidden" name="id">

                                                <div class="text-center">
                                                    Goal 1
                                                </div>
                                                <hr style="margin-top: 8px;">

                                                <div class="form-group">
                                                    <label class="pb-1">Point</label>
                                                    <select name="id_kamus" id="id_kamus" class="form-control select3">
                                                        <option value="">Pilih Point</option>
                                                        @foreach ($kamuss as $kamus)
                                                            <option value="{{ $kamus->id }}">
                                                                {{ ucfirst($kamus->area_kinerja_utama) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Goal Name</label>
                                                    <input type="text" name="goal_name" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Metric Description</label>
                                                    <textarea required class="form-control" name="metric_description" cols="30" rows="4"></textarea>
                                                    <small class="fst-italic">
                                                        Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir
                                                        kalimat.
                                                    </small>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Metric Scale</label>
                                                    <textarea required class="form-control" name="metric_scale" cols="30" rows="6"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Weight</label>
                                                    <input type="number" name="weight" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label class="pt-3 pb-1">Nilai Pencapaian SF (KPI GENERAL)</label>
                                                    <input type="text" name="nilai_pencapaian_sf" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pt-3">
                                            <div class="col">
                                                <button type="button" class="btn btn-sm fw-bold btn-primary btn-add-indicator">
                                                    + Goal
                                                </button>
                                                <button type="button" class="btn btn-sm fw-bold btn-info btn-add-category">
                                                    + BSC Category
                                                </button>
                                                <button data-id="${jumlahBoxItem + 1}" type="button" class="btn btn-sm fw-bold btn-danger btn-remove-category">
                                                    - BSC Category
                                                </button>
                                            </div>
                                        </div>
                                    </div>`;

                $("#myTab").append(templateTabItem);
                $("#myTabContent").append(templateTabContent);

                return newTabId;
            }

            // Function Generate Template Box Goal
            function generateTemplateBoxGoal() {
                var activeTabId = $('.tab-pane.active').attr('id'); // Mendapatkan ID tab yang sedang aktif
                var jumlahBoxItem = $("#" + activeTabId + " .box-container .box-item").length;
                var template =
                `<div data-boxid="${jumlahBoxItem + 1}" class="box-item border rounded p-2 mt-3">
                                        <input type="hidden" name="id">
                                        <div class="text-center position-relative py-2">
                                            <span class="position-absolute start-55 translate-middle" style="margin-top: 2px;">Goal ${jumlahBoxItem + 1}</span>
                                            <button type="button" class="px-1 py-0 fw-bold btn btn-sm btn-danger btn-remove-indicator position-absolute end-0 top-0">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <hr style="margin-top: 12px;">

                                        <div class="form-group">
                                            <label class="pb-1">Point</label>
                                            <select name="id_kamus" id="id_kamus" class="form-select select3">
                                                <option value="">Pilih Point</option>
                                                @foreach ($kamuss as $kamus)
                                                    <option value="{{ $kamus->id }}">
                                                        {{ ucfirst($kamus->area_kinerja_utama) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Goal Name</label>
                                            <input type="text" name="goal_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Description</label>
                                            <textarea required class="form-control" name="metric_description" cols="30" rows="4"></textarea>
                                            <small class="fst-italic">
                                                Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada akhir
                                                kalimat.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Scale</label>
                                            <textarea required class="form-control" name="metric_scale" cols="30" rows="6"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Weight</label>
                                            <input type="number" name="weight" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Nilai Pencapaian SF (KPI GENERAL)</label>
                                            <input type="text" name="nilai_pencapaian_sf" class="form-control">
                                        </div>
                                    </div>
                `;

                return [activeTabId, template];
            }

            // Function Remove and Add Modal
            function refreshModal() {
                $('#modal2 div.main').remove();

                var templateModalBody =
                    `<div class="main">
                        {{-- Tabs Item --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-danger active" id="tab-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-pane-1" type="button" role="tab">
                                    1
                                </button>
                            </li>
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-pane-1" role="tabpanel" tabindex="1">

                                <div class="form-group pt-3">
                                    <label class="pb-1">BSC Category 1</label>
                                    <input type="text" name="bsc_category" class="form-control" id="bsc_category">
                                </div>

                                <div class="box-container">
                                    <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                        <input type="hidden" name="id">

                                        <div class="text-center">
                                            Goal 1
                                        </div>
                                        <hr style="margin-top: 8px;">

                                        <div class="form-group">
                                            <label class="pb-1">Point</label>
                                            <select name="id_kamus" id="id_kamus" class="form-select select3">
                                                <option value="">Pilih Point</option>
                                                @foreach ($kamuss as $kamus)
                                                <option value="{{ $kamus->id }}">
                                                    {{ ucfirst($kamus->area_kinerja_utama) }} ({{ ($kamus->subdivisi == "ALL") ? "ALL TEAM" : $kamus->subdivisi }} @if($kamus->subdivisi != "ALL") -
                                                    Point {{ $kamus->baris }} @endif)</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Goal Name</label>
                                            <input type="text" name="goal_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Description</label>
                                            <textarea required class="form-control" name="metric_description" cols="30"
                                                rows="5"></textarea>
                                            <small class="fst-italic">
                                                Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada
                                                akhir
                                                kalimat.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Metric Scale</label>
                                            <textarea required class="form-control" name="metric_scale" cols="30"
                                                rows="6"></textarea>
                                            <small class="fst-italic">
                                                Catatan: Untuk enter atau pemisah kalimat perbaris, tambahkan @ pada
                                                akhir
                                                kalimat.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Weight</label>
                                            <input type="number" name="weight" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="pt-3 pb-1">Nilai Pencapaian SF (KPI GENERAL)</label>
                                            <input type="text" name="nilai_pencapaian_sf" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm fw-bold btn-primary btn-add-indicator">
                                            + Goal
                                        </button>
                                        <button type="button" class="btn btn-sm fw-bold btn-info  btn-add-category">
                                            + BSC Category
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;                            

                $('#modal2 div.modal-body').append(templateModalBody);
                $('#modal input[name="tahun"]').val('');
                $('#modal textarea[name="parameter"]').val('');
                $('#modal #file').val('');

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
            }

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

                reader.onload = function (e) {
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
    </script>
    @endpush
</div>
@endsection