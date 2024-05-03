@extends('layouts.dashboard', ['pageTitle' => 'KPI Individu Bulanan Group Leader'])

@section('breadcrumb')
<li class="breadcrumb-item active"><a>KPI Individu Bulanan Group Leader</a></li>
@endsection

@if (Auth::user()->kategori == 'GROUP LEADER')
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
            <button class="btn btn-primary fw-bold" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                Filter Data
            </button>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
                aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                    <div class="row">
                        <div class="col">
                            <label for="filter_subdivisi" class="pb-2 fw-bold">Filter Sub Divisi</label>
                            <select data-column="3" name="filter_subdivisi" id="filter_subdivisi"
                                class="form-control selectCanvas">
                                <option value="">Pilih Filter</option>
                                <option value="COMBEN">COMBEN</option>
                                <option value="REKRUT">REKRUT</option>
                                <option value="TND">TND</option>
                                <option value="IR">IR</option>
                            </select>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="col">
                            <label for="filter_nama" class="pb-2 fw-bold">Filter Nama</label>
                            <select data-column="2" name="filter_nama" id="filter_nama"
                                class="form-control selectCanvas">
                                <option value="">Pilih Filter</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="row pt-3">
                        <div class="col">
                            <label for="filter_periode" class="pb-2 fw-bold">Filter Periode</label>
                            <select data-column="1" name="filter_periode" id="filter_periode"
                                class="form-control selectCanvas">
                                <option value="">Pilih Filter</option>
                            </select>
                        </div>
                    </div>
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
                            <th class="text-center text-nowrap">Nama</th>
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
    <div class="modal fade" id="modal" aria-hidden="true" aria-labelledby="modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH KPI BULANAN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group pb-2">
                        <label class="pb-1">User</label>
                        <input class="form-control" type="hidden" name="id_user" id="id_user"
                            value="{{ Auth::user()->id }}">
                        <input class="form-control" type="text" disabled
                            value="{{ Auth::user()->nrp }} | {{ ucfirst(Auth::user()->nama) }}">
                    </div>

                    <div class="form-group form-periode">
                        <label for="periode" class="pb-1">Periode</label>
                        <select name="periode" id="periode" class="form-control select-periode-awal1">
                            <option value="">Pilih Periode</option>
                            @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}">{{ $periode->periode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="box-container mb-2">
                        <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                            <input type="hidden" name="id">

                            <div class="text-center">
                                Point KPI 1
                            </div>
                            <hr style="margin-top: 8px;">

                            <div class="form-group form-point pb-2">
                                <label class="pb-1">Point</label>
                                <select name="point_kpi" id="point_kpi" class="form-select select-point1"
                                    data-user="{{ Auth::user()->id }}" data-idselect="1">
                                    <option value="">Pilih Point</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <small class="fst-italic fw-light">
                        Catatan: Hapus point harus sesuai urutan paling bawah!.
                        <br>
                        Jika tidak, maka akan terjadi error.
                    </small>

                    <div class="row pt-3">
                        <div class="col">
                            <button type="button" class="btn btn-sm fw-bold btn-warning btn-add-point">
                                + Point KPI
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button data-bs-dismiss="modal" class="btn fw-bold btn-secondary">
                        Tutup
                    </button>
                    <button class="btn-simpan btn fw-bold btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal fade" id="modalDetail" aria-hidden="true" aria-labelledby="modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalLabel">Detail Data KPI Bulanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="label-table fw-bold d-inline-block mb-2 text-capitalize" style="font-size: 13px">
                    </span>
                    <div class="table-responsive">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-primary fw-bold" data-bs-dismiss="modal">
                        Tutup
                    </button>
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
                        "drawCallback": function() {
                            // Setelah DataTables selesai diinisialisasi, lakukan operasi yang Anda inginkan
                            var dataPeriode = dataTable.column(1).data();
                            var periode = [];
                            dataPeriode.each(function(value, index) {
                                periode.push(value);
                            });

                            var selectPeriode = $(`select[name="filter_periode"]`);

                            // Simpan nilai yang dipilih sebelumnya
                            selectedValue = selectPeriode.val();

                            // Kosongkan dulu elemen select jika ada opsi sebelumnya
                            selectPeriode.empty();
                            selectPeriode.append(`<option value="">Pilih Filter</option>`);

                            // Buat objek untuk menyimpan opsi yang unik
                            var uniqueOptions = {};

                            // Tambahkan opsi periode dari array `periode`
                            periode.forEach(function(value, index) {
                                // Jika nilai belum ada dalam objek uniqueOptions, tambahkan ke objek dan juga ke elemen select
                                if (!uniqueOptions[value]) {
                                    selectPeriode.append($('<option>', {
                                        value: value,
                                        text: value
                                    }));
                                    // Tandai nilai sebagai sudah ditambahkan
                                    uniqueOptions[value] = true;
                                }
                            });

                            // Pilih kembali nilai yang sebelumnya dipilih, jika ada
                            selectPeriode.val(selectedValue);
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
                                data: 'periode.periode'
                            },
                            {
                                data: 'user.nama'
                            },
                            {
                                data: 'user.subdivisi'
                            },
                            @if (Auth::user()->kategori == 'GROUP LEADER')
                                {
                                    data: 'id',
                                    render: function(data) {
                                        return `
                                            <button class="btnDetail btn fw-bold btn-sm btn-secondary d-inline" data-id="${data}">
                                                    <i class="bi bi-eye"></i></button>&nbsp;
                                            <button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                                    <i class="bi bi-pencil-square"></i></button>&nbsp;
                                            <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                                    <i class="bi bi-trash"></i></button>
                                        `;
                                    }
                                },
                            @else
                                {
                                    data: 'id',
                                    render: function(data) {
                                        return `
                                            <button class="btnDetail btn fw-bold btn-sm btn-secondary d-inline" data-id="${data}">
                                                <i class="bi bi-eye"></i></button>&nbsp;
                                        `;
                                    }
                                },
                            @endif
                        ],
                        columnDefs: [
                            {
                                targets: [0, 1, 3, 4],
                                className: "text-center align-middle text-capitalize text-nowrap"
                            },
                            {
                                targets: [2],
                                className: "align-middle text-capitalize text-nowrap"
                            },
                        ],
                    });

                    // Filter table
                    $('#filter_nama').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter table
                    $('#filter_subdivisi').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter table
                    $('#filter_periode').change(function() {
                        var value = $(this).val();
                        if (value === "") {
                            // Jika opsi dengan nilai kosong dipilih, hapus filter dan gambar ulang tabel
                            dataTable.column(1).search('').draw();
                        } else {
                            // Jika opsi selain nilai kosong dipilih, terapkan filter dan gambar ulang tabel
                            dataTable.column(1).search(value).draw();
                        }
                    });

                    // Proses tambah dan update
                    $(".btn-simpan").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        // Mengambil nilai dari input
                        var formData = getValueInput(["id_user", "periode"]);

                        // Ambil data point
                        var jumlahBoxItem = $(`#modal .box-container .box-item`).length;
                        var points = [];

                        for (let index = 0; index < jumlahBoxItem; index++) {

                            var value = $(`#modal [data-boxid="${index + 1}"] select[name="point_kpi"]`).val();

                            if(typeof value === "undefined") {
                                var value = $(`#modal [data-boxid="${index + 1}"] input[name="point_kpi"]`).val();   
                            }

                            points.push([
                                `"` + value + `"`,
                            ]);
                        }

                        formData.append("points", points);

                        var btnSimpan = $(".btn-simpan").text();
                        if(btnSimpan == "Simpan") {
                            var url = "{{ url()->current() }}";
                        }else if(btnSimpan == "Edit") {
                            var id = $(`input[name="idkpi"]`).val();
                            var url = `/kpi-individu-gl-bulanan/${id}`;
                            formData.append("_method", "PUT");
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
                                showAlert('error',
                                    "Terjadi kesalahan, pastikan data terisi dengan benar");
                            }
                        }).always(function() {
                            // Hilangkan loading
                            $(".load").addClass("d-none");
                        });
                    });

                    // Proses update
                    $(".btn-update").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        var formData = getValueInput(['periode_awal_edit', 'periode_akhir_edit']);
                        formData.append('_method', 'PUT');

                        // Ambil id
                        var id = $('.btn-update').attr("data-id");
                        var url = "{{ url()->current() }}/" + id;

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
                                    $("#modal-edit").modal("hide");

                                    // reload table
                                    dataTable.ajax.reload();
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

                        $("#modal .modal-body").append(`<input type="hidden" name="idkpi" value="${id}">`);

                        $(".btn-simpan").text("Edit");
                        $(".modal-title").text("EDIT KPI BULANAN");

                        $.ajax({
                            url: "{{ url()->current() }}/" + id + "/edit",
                            success: (response) => {
                                $("#modal").modal("show");

                                if (response.status == "success") {

                                    $("#periode").remove();
                                    $("#modal .form-periode").append(`
                                        <input class="form-control" name="periode" type="text" value="${response.data.periode.periode}" readonly>
                                        <input type="hidden" id="periode" value="${response.data.id_periode}">
                                    `);
                                    $("#periode").val(response.data.id_periode);
                                    $(".box-container").empty();
                                    var items = response.data.items;

                                    items.forEach((item, index) => {
                                        
                                        var jumlahBoxItem = $("#modal .box-container .box-item").length;
                                        var template =
                                            `<div data-boxid="${jumlahBoxItem + 1}" class="box-item border rounded p-2 mt-3">
                                                <input type="hidden" name="id">

                                                <div class="text-center position-relative py-2">
                                                    <span class="position-absolute start-55 translate-middle" style="margin-top: 2px;">Point KPI ${jumlahBoxItem + 1}</span>
                                                    <button type="button" class="px-1 py-0 fw-bold btn btn-sm btn-danger btn-remove-point position-absolute end-0 top-0">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                                <hr style="margin-top: 12px;">

                                                <div class="form-group pb-2">
                                                    <label class="pb-1">Point</label>
                                                    <input type="hidden" name="point_kpi" value="${item['id_kamus']}">
                                                    <input class="form-control" type="text" value="${item['kamus']['pointkpi']}" readonly>
                                                </div>
                                            </div>`;

                                        $("#modal .box-container").append(template);

                                        
                                    });
                                }
                            }
                        });
                    });

                    // Proses detail
                    $(document).on('click', '.btnDetail', function() {
                        var id = $(this).data('id');

                        // Fungsi ubah awalan kata jadi uppercase
                        function capitalizeFirstLetter(sentence) {
                            return sentence.replace(/\b\w/g, function(char) {
                                return char.toUpperCase();
                            });
                        }

                        $.ajax({
                            url: "{{ url()->current() }}/" + id + "/edit",
                            success: (response) => {

                                if (response.status == "success") {

                                    $("#modalDetail div.table-responsive").empty();

                                    var kpi = response.data;
                                    var template1 = `
                                        <table class="table table-striped table-hover table-bordered border-dark table-detail-kpi">
                                            <tr style="font-size: 11px; background-color: #fbeeb9;"
                                                class="align-middle text-center fw-bold">
                                                <th style="background-color: #fbeeb9;">No.</th>
                                                <th style="min-width: 300px; background-color: #fbeeb9;" class="text-nowrap">
                                                    Key Performance Indicators    
                                                </th>
                                                <th style="min-width: 75px; background-color: #fbeeb9;">Realisasi</th>
                                                <th style="min-width: 65px; background-color: #fbeeb9;">Konversi KPI SF</th>
                                                <th style="min-width: 75px; background-color: #fbeeb9;">Konversi Bintang</th>
                                            </tr>
                                    `;

                                    var template2 = ``;

                                    kpi.items.forEach(function(item, index) {
                                        template2 += `
                                            <tr class="align-top" style="font-size: 11px;">
                                                <td class="text-center">${index + 1}</td>
                                                <td>${item['kamus']['pointkpi']}</td>
                                                <td class="text-center">${item['realisasi']}</td>
                                                <td class="text-center">${item['konversi_sf']}</td>
                                                <td class="text-center">${item['konversi_bintang']}</td>
                                            </tr>
                                        `
                                    });

                                    var nama = kpi.user['nama'];
                                    var periode = kpi.periode.periode;
                                    var subdivisi = kpi.user['subdivisi'];
                                    if(subdivisi == "TND") {
                                        var subdivisiText = "Training & Development";
                                    }else if(subdivisi == "IR") {
                                        var subdivisiText = "Industrial Relation";
                                    }else if(subdivisi == "REKRUT") {
                                        var subdivisiText = "Rekrutmen";
                                    }else if(subdivisi == "COMBEN") {
                                        var subdivisiText = "Comben, Payroll, & PA";
                                    }

                                    $("#modalDetail #modalLabel").text("Detail Data KPI Bulanan");
                                    $("#modalDetail .label-table").text(`KPI Group Leader ${subdivisiText} - ${nama.toLowerCase()} - ${periode}`);
                                    $("#modalDetail div.table-responsive").append(template1 + template2);
                                    $("#modalDetail").modal("show");
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

                        $(".btn-simpan").text("Simpan");
                        $(".modal-title").text("TAMBAH KPI BULANAN");
                        $(`input[name="idkpi"]`).remove();

                        // Mengambil semua elemen .box-item di dalam .box-container
                        var semuaBoxItem = $("#modal .box-container .box-item").remove();

                        $("#periode").remove();
                        $(`input[name="periode"]`).remove();
                        $("#modal .form-periode").append(`
                            <select name="periode" id="periode" class="form-control select-periode-awal1">
                                <option value="">Pilih Periode</option>
                                @foreach ($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->periode }}</option>
                                @endforeach
                            </select>
                        `);

                        $("#modal .box-container").append(`
                            <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                <input type="hidden" name="id">

                                <div class="text-center">
                                    Point KPI 1
                                </div>
                                <hr style="margin-top: 8px;">

                                <div class="form-group form-point pb-2">
                                    <label class="pb-1">Point</label>
                                    <select name="point_kpi" id="point_kpi" class="form-select select-point1"
                                        data-user="{{ Auth::user()->id }}" data-idselect="1">
                                        <option value="">Pilih Point</option>
                                    </select>
                                </div>
                            </div>
                        `);

                        // Select Periode
                        $(`select[name="periode"]`).on("change", function() {

                            var periode = $(this).val();
                            var idUser = $(`input[name="id_user"]`).val();

                            if(periode != "") {
                                $.ajax({
                                    url: `kpi-individu-gl-bulanan/get-point/${idUser}/${periode}`,
                                    success: function(response) {
                                        if(response.status == "success") {

                                            var select = $(`select[name="point_kpi"]`);
                                            select.empty();
                                            select.append(`<option value="">Pilih Point</option>`);

                                            var options = [];
                                            var point = response.data;
                                            point.forEach(item => {
                                                options.push(`<option value="${item['id_kamus']}">${item['point']}</option>`);
                                            });
                                            var template = options.join(", ");

                                            select.append(template);
                                        }
                                    }
                                });
                            }
                        });
                    });

                    // Proses tambah point baru
                    $('.btn-add-point').on("click", function(event) {
                        var jumlahBoxItem = $("#modal .box-container .box-item").length;
                        var template =
                            `<div data-boxid="${jumlahBoxItem + 1}" class="box-item border rounded p-2 mt-3">
                                <input type="hidden" name="id">

                                <div class="text-center position-relative py-2">
                                    <span class="position-absolute start-55 translate-middle" style="margin-top: 2px;">Point KPI ${jumlahBoxItem + 1}</span>
                                    <button type="button" class="px-1 py-0 fw-bold btn btn-sm btn-danger btn-remove-point position-absolute end-0 top-0">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                <hr style="margin-top: 12px;">

                                <div class="form-group pb-2">
                                    <label class="pb-1">Point</label>
                                    <select name="point_kpi" id="point_kpi" class="form-select select3 point_kpi_baru"
                                        data-user="{{ Auth::user()->id }}" data-idselect="${jumlahBoxItem + 1}">
                                        <option value="">Pilih Point</option>
                                    </select>
                                </div>
                            </div>`;

                        $("#modal .box-container").append(template);

                        var periode = $("#periode").val();
                        var idUser = $(`input[name="id_user"]`).val();
                        var box = jumlahBoxItem + 1;

                        if(periode != "") {
                            $.ajax({
                                url: `kpi-individu-gl-bulanan/get-point/${idUser}/${periode}`,
                                success: function(response) {
                                    if(response.status == "success") {

                                        var select = $(`div[data-boxid="${box}"] .point_kpi_baru`);
                                        select.empty();
                                        select.append(`<option value="">Pilih Point</option>`);

                                        var options = [];
                                        var point = response.data;
                                        point.forEach(item => {
                                            options.push(`<option value="${item['id_kamus']}">${item['point']}</option>`);
                                        });
                                        var template = options.join(", ");

                                        select.append(template);
                                    }
                                }
                            });
                        }
                    });

                    // Proses hapus point
                    $(document).on('click', '.btn-remove-point', function() {
                        var boxItem = $(this).closest(".box-item");
                        boxItem.remove();
                    });

                    // Select Periode
                    $(`select[name="periode"]`).on("change", function() {

                        var periode = $(this).val();
                        var idUser = $(`input[name="id_user"]`).val();

                        if(periode != "") {
                            $.ajax({
                                url: `kpi-individu-gl-bulanan/get-point/${idUser}/${periode}`,
                                success: function(response) {
                                    if(response.status == "success") {

                                        var select = $(`select[name="point_kpi"]`);
                                        select.empty();
                                        select.append(`<option value="">Pilih Point</option>`);

                                        var options = [];
                                        var point = response.data;
                                        point.forEach(item => {
                                            options.push(`<option value="${item['id_kamus']}">${item['point']}</option>`);
                                        });
                                        var template = options.join(", ");

                                        select.append(template);
                                    }
                                }
                            });
                        }
                    });

                    // select2
                    $('.select3').select2({
                        dropdownParent: $('#modal'),
                        theme: 'bootstrap',
                    });

                    // select2
                    $('.selectCanvas').select2({
                        dropdownParent: $('.offcanvas'),
                        theme: 'bootstrap',
                    });
                });
    </script>
    @endpush
</div>
@endsection