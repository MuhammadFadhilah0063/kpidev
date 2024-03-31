// function hapus invalid pada input
function clearInvalidInput(array) {
  $.each(array, function (index, value) {
    if ($("#" + value).hasClass("is-invalid")) {
      $("#" + value).removeClass("is-invalid");
      var parent = $("#" + value).parent();

      // Menghapus elemen terakhir dari parent
      parent.children().last().remove();
    }
  });
}

// function menambah invalid pada input
function addInvalidInput(objects) {
  $.each(objects, function (key, value) {
    $("#" + key).addClass("is-invalid");
    $("#" + key)
      .parent()
      .append('<div class="invalid-feedback">' + value + "</div>");
  });
}

// function ambil semua input
function getValueInput(array) {
  var formData = new FormData();

  $.each(array, function (index, value) {
    formData.append(value, $("#" + value).val());
  });

  return formData;
}

// function menampilkan swal alert
function showAlert(icon, message) {
  Swal.fire({
    icon: icon,
    title: message,
    showConfirmButton: false,
    timer: 5000,
  });
}

// function menghapus isi pada input
function clearInput(array) {
  $.each(array, function (index, value) {
    $("#" + value).val("");
  });

  // Hapus image preview
  var preview = $("#imagePreview");

  if (preview) {
    preview.attr("src", "#");
    preview.css("display", "none");
  }
}

// function menampilkan image preview
function showImagePreview(file) {
  var preview = $("#imagePreview");

  if (preview) {
    preview.attr("src", "storage/foto_profil/" + file);
    preview.css("display", "block");
  }
}

// function mengubah huruf pertama kapital
function ucfirst(str) {
  // Mengecek apakah string kosong
  if (!str) return str;

  // Menggabungkan huruf pertama yang telah diubah menjadi kapital dengan sisa string
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// function untuk mendapatkan format tanggal Indonesia dari timestamp
function formatTanggalIndonesia(tanggal) {
  var options = {
    day: "numeric",
    month: "long",
    year: "numeric",
  };

  // Tanggal dan waktu awal dalam format UTC
  var tanggalWaktuUTC = new Date(tanggal);

  return new Intl.DateTimeFormat("id-ID", options).format(tanggalWaktuUTC);
}

function formatText(text) {
  var sentences = text.split("@");
  return sentences.join("<br>");
}
