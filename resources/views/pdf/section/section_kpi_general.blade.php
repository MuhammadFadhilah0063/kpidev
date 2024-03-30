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
            border: 1.5px solid;
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

        th#th-sf {
            border: 0.1px solid rgba(0, 0, 0, 0.659) !important;
            background-color: #71b361;
        }

        td.td-sf {
            border: 0.1px solid rgba(0, 0, 0, 0.659) !important;
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
                    <th>No</th>
                    <th class="text-nowrap">BSC Category</th>
                    <th>Goals Name</th>
                    <th>Metric Description</th>
                    <th>Metric Scale</th>
                    <th>Parameter</th>
                    <th>Weight</th>
                    <th id="th-sf">NILAI PENCAPAIAN SF (KPI GENERAL)</th>
                </tr>

                @foreach ($kpi->category_items as $index => $category)
                @if(count($category->goal_items) == 1)
                <tr class="tr-data">
                    <td class="td-no">{{ $index + 1 }}</td>
                    <td>{{ $category->bsc_category }}</td>
                    <td>{{ $category->goal_items[0]->goal_name }}</td>
                    <td>{{ formatText($category->goal_items[0]->metric_description) }}</td>
                    <td>{{ formatText($category->goal_items[0]->metric_scale) }}</td>
                    <td>{{ $kpi->parameter }}</td>
                    <td class="td-weight">{{ $category->goal_items[0]->weight }}%</td>
                    <td class="td-sf">{{ $category->goal_items[0]->nilai_pencapaian_sf }}</td>
                </tr>
                @else
                {{-- --}}
                @foreach ($category->goal_items as $i => $goal)
                @if($i == 0)
                <tr class="tr-data">
                    <td class="td-no">{{ $index + 1 }}</td>
                    <td>{{ $category->bsc_category }}</td>
                    <td>{{ $goal->goal_name }}</td>
                    <td>{{ formatText($goal->metric_description) }}</td>
                    <td>{{ formatText($goal->metric_scale) }}</td>
                    <td></td>
                    <td class="td-weight">{{ $goal->weight }}%</td>
                    <td class="td-sf">{{ $goal->nilai_pencapaian_sf }}</td>
                </tr>
                @else
                <tr class="tr-data">
                    <td></td>
                    <td></td>
                    <td>{{ $goal->goal_name }}</td>
                    <td>{{ formatText($goal->metric_description) }}</td>
                    <td>{{ formatText($goal->metric_scale) }}</td>
                    <td></td>
                    <td class="td-weight">{{ $goal->weight }}%</td>
                    <td class="td-sf">{{ $goal->nilai_pencapaian_sf }}</td>
                </tr>
                @endif
                @endforeach
                {{-- --}}
                @endif
                @endforeach

                <tr class="tr-data total-value">
                    <td colspan="6"></td>
                    <td>{{ $kpi->total }}%</td>
                    <td style="border: none; background-color: transparent;"></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>