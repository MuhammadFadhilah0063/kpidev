<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="data:image/png;base64,{{ base64_encode(file_get_contents('assets/icons/ICONPPA.png')) }}" rel="icon"
        type="image/png">
    <title>KPI {{ $kpi->tahun }} HCGA SITE (SH HC)</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: transparent !important;
        }

        .page-break {
            page-break-after: always;
        }

        tr.tr-data>th,
        tr.tr-data>td {
            border: 1px solid;
            color: black;
        }

        th {
            padding: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: capitalize;
            background-color: #fbeeb9;
            text-align: center;
            vertical-align: middle;
        }

        td.td-weight,
        td.td-no {
            text-align: center;
        }

        td {
            padding: 2px;
            font-size: 10px;
            text-align: start;
            vertical-align: text-top;
        }

        .total-value {
            background-color: #fbeeb9;
            font-weight: bold;
            text-align: center;
        }

        /* Isi End */
    </style>
</head>

<body>
    <div class="body">

        <div class="row" style="margin-top: 30px;">
            <span class="fw-bold d-inline-block pb-1" style="font-size: 12px">
                KPI {{ $kpi->tahun }} HCGA SITE (SH HC)
            </span>
            <table>
                <tr class="tr-data">
                    <th style="min-width: 18px;">No</th>
                    <th style="min-width: 79px;" class="text-nowrap">BSC Category</th>
                    <th style="min-width: 110px;">Goals Name</th>
                    <th style="min-width: 195px;">Metric Description</th>
                    <th style="min-width: 195px;">Metric Scale</th>
                    <th style="min-width: 130px;">Parameter</th>
                    <th class="text-wrap" style="width: 75px;">Nilai</br>Pencapaian SF</th>
                    <th style="width: 64px;">Konversi</br>Bintang</th>
                    <th style="width: 44px;">Weight</th>
                </tr>

                @foreach ($kpi->category_items as $index => $category)
                    {{-- @if (count($category->goal_items) == 1) --}}
                    @if ($index == 0)
                        {{-- --}}
                        @foreach ($category->goal_items as $i => $goal)
                            @if ($i == 0)
                                <tr class="tr-data">
                                    <td class="td-no">{{ $index + 1 }}</td>
                                    <td>{{ $category->bsc_category }}</td>
                                    <td>{{ $goal->goal_name }}</td>
                                    <td>{{ formatText($goal->metric_description) }}</td>
                                    <td>{{ formatText($goal->metric_scale) }}</td>
                                    <td>{{ formatText($kpi->parameter) }}</td>
                                    <td class="text-center">{{ $goal->nilai_pencapaian_sf }}</td>
                                    <td class="text-center">{{ $goal->konversi_bintang }}</td>
                                    <td class="td-weight">{{ $goal->weight }}%</td>
                                </tr>
                            @else
                                <tr class="tr-data">
                                    <td></td>
                                    <td></td>
                                    <td>{{ $goal->goal_name }}</td>
                                    <td>{{ formatText($goal->metric_description) }}</td>
                                    <td>{{ formatText($goal->metric_scale) }}</td>
                                    <td></td>
                                    <td class="text-center">{{ $goal->nilai_pencapaian_sf }}</td>
                                    <td class="text-center">{{ $goal->konversi_bintang }}</td>
                                    <td class="td-weight">{{ $goal->weight }}%</td>
                                </tr>
                            @endif
                        @endforeach
                        {{-- --}}
                    @else
                        {{-- --}}
                        @foreach ($category->goal_items as $i => $goal)
                            @if ($i == 0)
                                <tr class="tr-data">
                                    <td class="td-no">{{ $index + 1 }}</td>
                                    <td>{{ $category->bsc_category }}</td>
                                    <td>{{ $goal->goal_name }}</td>
                                    <td>{{ formatText($goal->metric_description) }}</td>
                                    <td>{{ formatText($goal->metric_scale) }}</td>
                                    <td></td>
                                    <td class="text-center">{{ $goal->nilai_pencapaian_sf }}</td>
                                    <td class="text-center">{{ $goal->konversi_bintang }}</td>
                                    <td class="td-weight">{{ $goal->weight }}%</td>
                                </tr>
                            @else
                                <tr class="tr-data">
                                    <td></td>
                                    <td></td>
                                    <td>{{ $goal->goal_name }}</td>
                                    <td>{{ formatText($goal->metric_description) }}</td>
                                    <td>{{ formatText($goal->metric_scale) }}</td>
                                    <td></td>
                                    <td class="text-center">{{ $goal->nilai_pencapaian_sf }}</td>
                                    <td class="text-center">{{ $goal->konversi_bintang }}</td>
                                    <td class="td-weight">{{ $goal->weight }}%</td>
                                </tr>
                            @endif
                        @endforeach
                        {{-- --}}
                    @endif
                @endforeach

                <tr class="tr-data total-value">
                    <td colspan="8"></td>
                    <td>{{ $kpi->total }}%</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
