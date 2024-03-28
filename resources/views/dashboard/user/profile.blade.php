@extends('layouts.dashboard', ['pageTitle' => 'Profile'])

@section('breadcrumb')
    <li class="breadcrumb-item active">Profile</a></li>
@endsection

@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/foto_profil/' . Auth::user()->foto_profil) }}" alt="Profile"
                            class="rounded img-thumbnail">
                        <h2>{{ Auth::user()->nama }}</h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Detail Profil</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8">: {{ ucfirst(Auth::user()->nama) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NRP</div>
                                <div class="col-lg-9 col-md-8">: {{ strtolower(Auth::user()->nrp) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kategori</div>
                                <div class="col-lg-9 col-md-8">: {{ Auth::user()->kategori }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Sub Divisi</div>
                                <div class="col-lg-9 col-md-8">
                                    : {{ strtoupper(Auth::user()->subdivisi ? Auth::user()->subdivisi : '-') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col label text-center py-3">Tanda Tangan</div>
                                <div class="col-12 text-center">
                                    @if (Auth::user()->ttd)
                                        <img id="imagePreview" src="{{ asset('storage/ttd/' . Auth::user()->ttd) }}"
                                            alt="Tanda tangan" class="rounded border p-4"
                                            style="max-width: 100%; max-height: 300px; margin: 0 auto;">
                                    @else
                                        <img id="imagePreview" src="{{ asset('storage/ttd/default.png') }}"
                                            alt="Tanda tangan" class="rounded border p-4"
                                            style="max-width: 100%; max-height: 300px; margin: 0 auto;">
                                    @endif
                                </div>

                                <form enctype="multipart/form-data">
                                    <div class="form-group pt-3">
                                        <label>Tanda Tangan</label>
                                        <div class="input-group mt-1">
                                            <input type="file" class="form-control" name="ttd" id="ttd"
                                                accept="image/*" onchange="previewImage(this);">
                                            <button class="btn btn-outline-primary" type="button"
                                                id="btnUpdate">Simpan</button>
                                        </div>
                                        <small class="fst-italic">
                                            Pilih file foto, jika ingin upload foto tanda tangan.
                                        </small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Function Image Preview
            function previewImage(input) {
                var preview = document.getElementById('imagePreview');
                var file = input.files[0];
                var reader = new FileReader();

                reader.onloadend = function() {
                    preview.src = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                }
            }

            $(document).ready(function() {

                // Proses update
                $("#btnUpdate").on("click", function(event) {
                    // Tampil loading
                    $(".load").removeClass("d-none");

                    var formData = new FormData();
                    formData.append('_method', 'PUT');

                    // Mengambil input file foto
                    var fileInput = document.getElementById("ttd");
                    var file = fileInput.files[0];
                    formData.append("ttd", file);

                    // Mengambil nilai token CSRF dari tag meta
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Melakukan request AJAX
                    $.ajax({
                        type: "POST",
                        url: "user/{{ Auth::user()->id }}/update-ttd",
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
                                location.reload();
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
                });
            });
        </script>
    @endpush
@endsection
