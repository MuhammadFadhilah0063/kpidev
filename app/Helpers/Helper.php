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
