<?php

namespace App\Imports;

use App\Models\FundRequest;

use App\Models\FundRequestOffer;
use App\Models\FundRequestSmsStatus;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class FundOfferSmsExport implements FromView, WithColumnWidths
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    /*
    public function collection()
    {
        return RequestFund::with('neighborhood','offers')->get();
    }


    public function map($invoice): array
    {
        return [
           'id'=>$invoice->id,
           'date'=>Date::dateTimeToExcel($invoice->created_at),
        ];


    }*/


    public function __construct()
    {

    }

    public function view(): View
    {


        return view('fundOfferSms', [
            'offers' => FundRequestSmsStatus::get()
        ]);

    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 40,
            'C' => 20,
            'D' => 50,
            'E' => 30,
            'F' => 30,
            'G' => 10,
            'H' => 10,
            'I' => 10,
        ];
    }
}
