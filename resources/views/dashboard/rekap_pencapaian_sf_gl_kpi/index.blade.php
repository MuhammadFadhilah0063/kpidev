@extends('layouts.dashboard', ['pageTitle' => 'Data Rekap Pencapaian SF KPI Individu Group Leader'])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a>Rekap Pencapaian SF KPI Individu Group Leader</a></li>
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
                                    <select data-column="6" name="filter_subdivisi" id="filter_subdivisi"
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
                                    <select data-column="5" name="filter_nama" id="filter_nama"
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
                                <label for="filter_point" class="pb-2 fw-bold">Filter Point</label>
                                <select data-column="2" name="filter_point" id="filter_point"
                                    class="form-control selectCanvas">
                                    <option value="">Pilih Filter</option>
                                    @foreach ($points as $point)
                                        <option value="{{ $point->pointkpi }}">{{ $point->pointkpi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col">
                                <label for="filter_periode" class="pb-2 fw-bold">Filter Periode</label>
                                <select data-column="5" name="filter_periode" id="filter_periode"
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
                                <th class="text-center text-nowrap">Point KPI</th>
                                <th class="text-center text-nowrap">Pencapaian SF</th>
                                <th class="text-center text-nowrap">Konversi Bintang</th>
                                @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                                    <th class="text-center text-nowrap">Nama</th>
                                    <th class="text-center text-nowrap">Sub Divisi</th>
                                @endif
                                @if (Auth::user()->kategori == 'GROUP LEADER')
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

        {{-- Modal --}}
        <div class="modal fade" id="modal" aria-hidden="true" aria-labelledby="modalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">TAMBAH REKAP PENCAPAIAN SF KPI BARU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="pb-1">User</label>
                            <input class="form-control" type="hidden" name="id_user" id="id_user"
                                value="{{ Auth::user()->id }}">
                            <input class="form-control" type="text" disabled
                                value="{{ Auth::user()->nrp }} | {{ ucfirst(Auth::user()->nama) }}">
                        </div>

                        <div class="box-container">
                            <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                <input type="hidden" name="id">

                                <div class="text-center">
                                    Point KPI 1
                                </div>
                                <hr style="margin-top: 8px;">

                                <div class="form-group form-point">
                                    <label class="pb-1">Point</label>
                                    <select name="point_kpi" id="point_kpi" class="form-select select-point1"
                                        data-user="{{ Auth::user()->id }}" data-idselect="1">
                                        <option value="">Pilih Point</option>
                                        @if (Auth::user()->kategori == 'GROUP LEADER')
                                            @foreach ($pointkpis as $point)
                                                <option value="{{ $point }}">
                                                    {{ $point }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="row pt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Awal</label>
                                            <select disabled name="periode_awal" id="periode"
                                                class="form-control select-periode-awal1">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Akhir</label>
                                            <select disabled name="periode_akhir" id="periode"
                                                class="form-control select-point1">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

        {{-- Modal Edit --}}
        <div class="modal fade" id="modal-edit" aria-hidden="true" aria-labelledby="modalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">EDIT REKAP PENCAPAIAN SF KPI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="pb-1">User</label>
                            <input class="form-control" type="hidden" name="id_user" id="id_user"
                                value="{{ Auth::user()->id }}">
                            <input class="form-control" type="text" disabled
                                value="{{ Auth::user()->nrp }} | {{ ucfirst(Auth::user()->nama) }}">
                        </div>

                        <div class="box-container">
                            <div data-boxid="1" class="box-item border rounded p-2 mt-3">
                                <input type="hidden" name="id">

                                <div class="text-center">
                                    Point KPI
                                </div>
                                <hr style="margin-top: 8px;">

                                <div class="form-group form-point">
                                    <label class="pb-1">Point</label>
                                    <input disabled class="form-control" name="point_kpi_edit" id="point_kpi_edit"
                                        type="text">
                                </div>

                                <div class="row pt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Awal</label>
                                            <select name="periode_awal_edit" id="periode_awal_edit" class="form-control">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Akhir</label>
                                            <select name="periode_akhir_edit" id="periode_akhir_edit"
                                                class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button data-bs-dismiss="modal" class="btn fw-bold btn-secondary">
                            Tutup
                        </button>
                        <button class="btn-update btn fw-bold btn-primary">
                            Edit
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
                                data: 'point_kpi'
                            },
                            {
                                data: 'rata_rata_pencapaian_sf'
                            },
                            {
                                data: 'konversi_bintang'
                            },
                            @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                                {
                                    data: 'user.nama'
                                }, {
                                    data: 'user.subdivisi'
                                },
                            @endif
                            @if (Auth::user()->kategori == 'GROUP LEADER')
                                {
                                    data: 'id',
                                    render: function(data) {
                                        return `
                                    <button class="btnEdit btn fw-bold btn-sm btn-warning d-inline" data-id="${data}">
                                            <i class="bi bi-pencil-square"></i></button>&nbsp;
                                    <button class="btnHapus btn fw-bold btn-sm btn-danger d-inline" data-id="${data}">
                                            <i class="bi bi-trash"></i></button>`;
                                    }
                                },
                            @endif
                        ],
                        columnDefs: [
                            @if (Auth::user()->kategori == 'MASTER' || Auth::user()->kategori == 'SECTION')
                                {
                                    targets: [0, 1, 3, 4, 6],
                                    className: "text-center align-middle text-capitalize text-nowrap"
                                }, {
                                    targets: [5],
                                    className: "align-middle text-capitalize text-nowrap"
                                },
                            @else
                                {
                                    targets: [0, 1, 3, 4, 5],
                                    className: "text-center align-middle text-capitalize text-nowrap"
                                },
                            @endif {
                                targets: [2],
                                className: "align-middle text-capitalize text-nowrap"
                            },
                        ],
                        "initComplete": function() {
                            // Setelah DataTables selesai diinisialisasi, lakukan operasi yang Anda inginkan
                            var dataPeriode = dataTable.column(1).data();
                            var periode = [];
                            dataPeriode.each(function(value, index) {
                                periode.push(value);
                            });

                            var selectPeriode = $(`select[name="filter_periode"]`);

                            // Kosongkan dulu elemen select jika ada opsi sebelumnya
                            selectPeriode.empty();
                            selectPeriode.append(`<option value="">Pilih Filter</option>`);

                            // Tambahkan opsi periode dari array `periode`
                            periode.forEach(function(value, index) {
                                selectPeriode.append($('<option>', {
                                    value: value,
                                    text: value
                                }));
                            });
                        }
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
                    $('#filter_point').change(function() {
                        dataTable.column($(this).data('column')).search($(this).val()).draw();
                    });

                    // Filter table
                    $('#filter_periode').change(function() {
                        dataTable.column(1).search($(this).val()).draw();
                    });

                    // Proses tambah
                    $(".btn-simpan").on("click", function(event) {
                        // Tampil loading
                        $(".load").removeClass("d-none");

                        // Mengambil nilai dari input
                        var formData = getValueInput(["id_user"]);

                        // Ambil data point
                        var jumlahBoxItem = $(`#modal .box-container .box-item`).length;
                        var points = [];

                        for (let index = 0; index < jumlahBoxItem; index++) {
                            points.push([
                                `"` + $(`#modal [data-boxid="${index + 1}"] select[name="point_kpi"]`)
                                .val() + `"`,
                                `"` + $(`#modal [data-boxid="${index + 1}"] select[name="periode_awal"]`)
                                .val() + `"`,
                                `"` + $(`#modal [data-boxid="${index + 1}"] select[name="periode_akhir"]`)
                                .val() + `"`,
                            ]);
                        }

                        formData.append("points", points);

                        var url = "{{ url()->current() }}";

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
                                    "Terjadi kesalahan, pastikan data periode terisi dengan benar");
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

                        // Menambahkan data-id pada button
                        $('.btn-update').attr("data-id", id);

                        $.ajax({
                            url: "{{ url()->current() }}/" + id + "/edit",
                            success: (response) => {
                                $("#modal-edit").modal("show");

                                if (response.data) {

                                    $('input[name="point_kpi_edit"]').val(response.data.point_kpi);

                                    var periodeAwal = $('select[name="periode_awal_edit"]');
                                    var periodeAkhir = $('select[name="periode_akhir_edit"]');

                                    periodeAwal.empty();
                                    periodeAkhir.empty();

                                    var periodes = response.periodes;
                                    var template = `<option value="">Pilih Periode</option>`;
                                    periodes.forEach(function(item) {
                                        template +=
                                            `<option value="${item.tanggal}">${item.periode}</option>`;
                                    });

                                    periodeAwal.append(template);
                                    periodeAkhir.append(template);

                                    var periode = (response.data.periode).split(" - ");

                                    periodeAwal.find('option').filter(function() {
                                        // Menggunakan .text() untuk membandingkan teks dalam opsi
                                        return $(this).text() === periode[0];
                                    }).prop('selected', true);

                                    periodeAkhir.find('option').filter(function() {
                                        // Menggunakan .text() untuk membandingkan teks dalam opsi
                                        return $(this).text() === periode[1];
                                    }).prop('selected', true);

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

                        // Mengambil semua elemen .box-item di dalam .box-container
                        var semuaBoxItem = $("#modal .box-container .box-item");

                        // Mengambil jumlah elemen .box-item
                        var jumlahBoxItem = semuaBoxItem.length;

                        // Menyaring elemen-elemen kecuali yang pertama
                        var boxItemYangDibiarkan = semuaBoxItem.not(":first");

                        // Menghapus elemen-elemen yang tidak disaring
                        boxItemYangDibiarkan.remove();
                    });

                    // Proses Get Periode KPI
                    $(document).on('change', 'select[name="point_kpi"]', function() {

                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var point = $(this).val();

                        // Set select null dan disabled
                        ($(this).closest('.box-item')).find('select[name="periode_awal"]').empty();
                        ($(this).closest('.box-item')).find('select[name="periode_awal"]').attr('disabled',
                            'disabled');
                        ($(this).closest('.box-item')).find('select[name="periode_akhir"]').empty();
                        ($(this).closest('.box-item')).find('select[name="periode_akhir"]').attr('disabled',
                            'disabled');

                        if (point != "") {
                            $.ajax({
                                url: `/get-kpi-individu-gl-periode`,
                                type: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                data: {
                                    point: point,
                                    user: $(this).data('user'),
                                    id_select: $(this).data('idselect'),
                                },
                                success: function(data) {
                                    var select = $(`select[data-idselect="${data.data.id_select}"]`);
                                    var boxItem = select.closest('.box-item');
                                    var periodeAwal = boxItem.find('select[name="periode_awal"]');
                                    var periodeAkhir = boxItem.find('select[name="periode_akhir"]');

                                    var periodes = data.data.periodes;
                                    var template = `<option value="">Pilih Periode</option>`;
                                    periodes.forEach(function(item) {
                                        template +=
                                            `<option value="${item.tanggal}">${item.periode}</option>`;
                                    });

                                    periodeAwal.append(template);
                                    periodeAwal.removeAttr('disabled');
                                    periodeAkhir.append(template);
                                    periodeAkhir.removeAttr('disabled');
                                },
                                error: function() {}
                            });
                        }
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

                                <div class="form-group">
                                    <label class="pb-1">Point</label>
                                    <select name="point_kpi" id="point_kpi" class="form-select select3"
                                        data-user="{{ Auth::user()->id }}" data-idselect="${jumlahBoxItem + 1}">
                                        <option value="">Pilih Point</option>
                                        @if (Auth::user()->kategori == 'GROUP LEADER')
                                        @foreach ($pointkpis as $point)
                                        <option value="{{ $point }}">
                                            {{ $point }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="row pt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Awal</label>
                                            <select disabled name="periode_awal" id="periode" class="form-control select-periode-awal1">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="pb-1">Periode Akhir</label>
                                            <select disabled name="periode_akhir" id="periode" class="form-control select-periode-akhir1">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        $("#modal .box-container").append(template);
                    });

                    // Proses hapus point
                    $(document).on('click', '.btn-remove-point', function() {
                        var boxItem = $(this).closest(".box-item");
                        boxItem.remove();
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
