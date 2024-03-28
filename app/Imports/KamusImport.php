<?php

namespace App\Imports;

use App\Models\Kamuskpi;
use Maatwebsite\Excel\Concerns\ToModel;

class KamusImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Kamuskpi([
            'pointkpi'           => $row[0],
            'subdivisi'          => ucwords($row[1]),
            'target'    => ucwords($row[2]),
            'unit_target'        => ucwords($row[3]),
            'kategori'       => strtoupper($row[4]),
        ]);
    }
}
