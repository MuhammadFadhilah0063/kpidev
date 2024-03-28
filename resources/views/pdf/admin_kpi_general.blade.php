<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="data:image/png;base64,{{ base64_encode(file_get_contents('assets/icons/ICONPPA.png')) }}" rel="icon"
        type="image/png">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: transparent !important;
        }

        .page-break {
            page-break-after: always;
        }

        tr.tr-data,
        tr.tr-data>th,
        tr.tr-data>td {
            border: 1px solid;
            text-align: center;
            vertical-align: middle;
            color: black;
        }

        th {
            padding: 6px;
            font-size: 11px;
            font-weight: bold;
            text-transform: capitalize;
            background-color: #fed634;
        }

        td {
            padding: 6px;
            font-size: 11px;
        }

        .total {
            background-color: rgb(227, 227, 227);
            font-weight: bold;
        }

        .total-value {
            background-color: #fed634;
            font-weight: bold;
        }

        /* Isi End */
    </style>
</head>

<body>
    <div class="body">

        <div class="row" style="margin-top: 30px;">
            <span class="fw-bold d-inline-block pb-2" style="font-size: 13px">{{ $title }}</span>
            <table>
                <tr class="tr-data">
                    <th>No.</th>
                    <th style="width: 250px;">Area Kinerja Utama</th>
                    <th>Key Performance Indicators</th>
                    <th>Bobot</th>
                    <th>Target</th>
                    <th>Realisasi</th>
                    <th>Skor</th>
                    <th style="max-width: 70px;">Skor Akhir (skor x bobot)/100</th>
                </tr>
                @foreach ($kpi->items as $index => $item)
                    <tr class="tr-data">
                        @if ($index + 1 == 1)
                            <td rowspan="5">{{ $index + 1 }}</td>
                        @elseif($index + 1 == 2 || $index + 1 == 3 || $index + 1 == 4 || $index + 1 == 5)

                        @elseif($index + 1 == 6)
                            <td rowspan="2">{{ $index - 3 }}</td>
                        @elseif($index + 1 == 7)
                        @else
                            <td>{{ $index - 4 }}</td>
                        @endif
                        @if ($index + 1 == 1)
                            <td rowspan="5" class="text-start text-capitalize">
                                {{ $item->key_kamus->kamus->area_kinerja_utama }}
                            </td>
                        @elseif($index + 1 == 2 || $index + 1 == 3 || $index + 1 == 4 || $index + 1 == 5)

                        @elseif($index + 1 == 6)
                            <td rowspan="2" class="text-start text-capitalize">
                                {{ $item->key_kamus->kamus->area_kinerja_utama }}
                            </td>
                        @elseif($index + 1 == 7)
                        @else
                            <td class="text-start text-capitalize">
                                {{ $item->key_kamus->kamus->area_kinerja_utama }}
                            </td>
                        @endif
                        <td class="text-start text-capitalize">
                            {{ formatText($item->key_kamus->indicator) }}
                        </td>
                        <td>{{ $item->key_kamus->bobot }}</td>
                        <td>{{ formatText($item->key_kamus->target) }}</td>
                        <td>{{ formatText($item->realisasi) }}</td>
                        <td>{{ $item->skor }}</td>
                        <td>{{ $item->skor_akhir }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5"></td>
                    <td colspan="2" class="total text-center" style="border: 1px black solid;">TOTAL</td>
                    <td class="total-value text-center" style="border: 1px black solid;">{{ $kpi->total }}</td>
                </tr>
            </table>
        </div>

        {{-- TTD --}}
        <table style="margin-top: 35px; margin-left: 120px;" id="table-ttd">
            <tr>
                <td colspan="4"></td>
                <td style="padding-bottom: 1px;" class="text-start text-capitalize text-nowrap">
                    Girimulya, {{ formatDateWithTime($kpi->updated_at) }}
                </td>
            </tr>
            <tr>
                <td class="text-start text-capitalize text-nowrap" style="padding-bottom: 7px;">Disetujui Oleh,</td>
                <td class="text-start text-capitalize text-nowrap" style="padding-bottom: 7px;"></td>
                <td class="text-start text-capitalize text-nowrap" style="padding-bottom: 7px;">Diperiksa Oleh,</td>
                <td class="text-start text-capitalize text-nowrap" style="padding-bottom: 7px;"></td>
                <td class="text-start text-capitalize text-nowrap" style="padding-bottom: 7px;">Dibuat Oleh,</td>
            </tr>

            {{-- Bagian Kosong --}}
            <tr>
                <td class="text-center" style="padding-bottom: 0px; padding-top: 0px;">

                </td>
                <td style="min-width: 230px; padding-top: 60px;"></td>
                <td class="text-center" style="padding-bottom: 0px; padding-top: 0px;">

                </td>
                <td style="min-width: 230px; padding-top: 60px;"></td>
                <td class="text-center" style="padding-bottom: 0px; padding-top: 0px;">
                    <img height="70px"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents("storage/ttd/{$kpi->user->ttd}")) }}">
                </td>
            </tr>

            {{-- Nama --}}
            <tr>
                <td style="padding-top: 0px;" class="text-start text-capitalize text-nowrap">
                    <span style="text-decoration: underline; display: block; padding-bottom: 5px; font-weight: bold">
                    </span>
                    Section Head HCGA
                </td>
                <td></td>
                <td style="padding-top: 0px;" class="text-start text-capitalize text-nowrap">
                    <span style="text-decoration: underline; display: block; padding-bottom: 5px; font-weight: bold">
                    </span>
                    Group Leader HCGA
                </td>
                <td></td>
                <td style="padding-top: 0px;" class="text-start text-capitalize text-nowrap">
                    <span style="text-decoration: underline; display: block; padding-bottom: 5px; font-weight: bold">
                        {{ $kpi->user->nama }}
                    </span>
                    Admin HCGA
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
