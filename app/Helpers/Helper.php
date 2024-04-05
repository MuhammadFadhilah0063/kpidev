<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

function formatDate($date)
{
  if ($date != null) {
    Date::setLocale('id');
    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
    return $carbonDate->translatedFormat('d F Y');
  } else {
    return "-";
  }
}

function startsWith($string, $prefix)
{
  return substr($string, 0, strlen($prefix)) === $prefix;
}

function formatDateWithTime($date)
{
  Date::setLocale('id');
  $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
  return $carbonDate->translatedFormat('d F Y');
}

function formatText($text)
{
  $sentences = explode('@', $text);
  echo implode('<br>', $sentences);
}

function explodeBulanDanTahun($periode)
{
  $bulanTahun = explode(" ", $periode);
  $tahun = $bulanTahun[1];
  $bulan = '';

  switch ($bulanTahun[0]) {
    case 'Januari':
      $bulan = '01';
      break;
    case 'Februari':
      $bulan = '02';
      break;
    case 'Maret':
      $bulan = '03';
      break;
    case 'April':
      $bulan = '04';
      break;
    case 'Mei':
      $bulan = '05';
      break;
    case 'Juni':
      $bulan = '06';
      break;
    case 'Juli':
      $bulan = '07';
      break;
    case 'Agustus':
      $bulan = '08';
      break;
    case 'September':
      $bulan = '09';
      break;
    case 'Oktober':
      $bulan = '10';
      break;
    case 'November':
      $bulan = '11';
      break;
    case 'Desember':
      $bulan = '12';
      break;
    default:
      $bulan = '01'; // Default ke Januari jika nama bulan tidak cocok
      break;
  }

  return "$tahun-$bulan-01";
}

function helperArrayFilterKPI($isifilter)
{

  $datafilters = explode(",", $isifilter);

  // Looping melalui setiap elemen array
  foreach ($datafilters as $key => $element) {
    // Menghapus karakter awalan dan akhiran "
    $datafilters[$key] = trim($element, '"');
  }

  $filters = array_chunk($datafilters, 3);

  // Jadikan baris atau point jadi array dengan pemisah "-"
  $newFilters = [];
  foreach ($filters as $filter) {
    // Memecah nilai pada indeks kedua menjadi array dan mengubahnya menjadi integer
    if (strpos($filter[1], "-")) {
      $filter[1] = array_map('intval', explode("-", $filter[1]));
    } else {
      $filter[1] = [(int) $filter[1]];
    }
    // Menambahkan filter yang telah dimodifikasi ke dalam array baru
    $newFilters[] = $filter;
  }

  return $newFilters;
}
