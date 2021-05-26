<?php

namespace App\Imports;

use App\City;
use Maatwebsite\Excel\Concerns\ToModel;

class FundValidUuidExport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new \App\Models\ValidUuid([

            'uuid'     => $row[0],


        ]);
    }
}
