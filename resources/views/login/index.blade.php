@extends('layouts.login')

@section('form')
<form class="row g-3 needs-validation" method="POST" novalidate>
    <div class="col-12">
        <label for="nrp" class="form-label">NRP</label>
        <div class="input-group has-validation">
            <input type="text" name="nrp" class="form-control" id="nrp" required autofocus>
        </div>
    </div>

    <div class="col-12">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>

    <div class="col-12 mt-4 text-center">
        <button class="btn btn-success w-100 fw-bold text-white" type="submit" id="btnMasuk">Masuk</button>
    </div>
</form>

@push('scripts')
<script>
    // Proses login
            $(document).ready(() => {

                // Menanggapi klik pada tombol "Masuk"
                $("#btnMasuk").on("click", function(event) {
                    // Mencegah form dikirim
                    event.preventDefault();

                    // Mengambil nilai dari input
                    var data = {
                        nrp: $("#nrp").val(),
                        password: $("#password").val(),
                        id_status: $("#id_status").val(),
                    }

                    // Mengambil nilai token CSRF dari tag meta
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Tampilkan loading
                    $(".load").removeClass("d-none");

                    // Melakukan request AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ route('login') }}",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: data,
                        success: function(response) {

                            // Hilangkan loading
                            $(".load").addClass("d-none");

                            if (response.status == "success") {
                                window.location.href = "/";
                            } else {

                                // Alert
                                Swal.fire({
                                    icon: "error",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                $(".alert-box").removeClass("d-none");
                                $(".text-alert").html(response.message);
                            }

                        },
                        error: function(error) {

                            // Alert
                            Swal.fire({
                                icon: "error",
                                title: "Error sistem",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });
</script>
@endpush
@endsection