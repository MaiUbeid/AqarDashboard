<?php

namespace App\Imports;

use App\Models\FundRequest;

use App\Models\FundRequestOffer;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class FundOfferExport implements FromView, WithColumnWidths
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

    private $fromdate;
    private $todate;

    public function __construct(string $fromdate,string $todate,string $status)
    {
        $this->fromdate = $fromdate;
        $this->todate = $todate;
        $this->status = $status;
    }

    public function view(): View
    {

        if($this->status != 'all')
        {
            return view('fundOffer', [
                'offers' => FundRequestOffer::whereHas('estate')->whereHas('provider')->whereHas('fund_request')->with('estate', 'provider')
                    ->whereDate(
                        'created_at',
                        '>=',

                        Carbon::parse($this->fromdate)->format('Y-m-d')
                    )
                    ->whereDate(
                        'created_at',
                        '<=',

                        Carbon::parse($this->todate)->format('Y-m-d')
                    )
                    ->where('status', $this->status)
                    ->get()
            ]);
        }
        return view('fundOffer', [
            'offers' => FundRequestOffer::whereHas('estate')->whereHas('provider')->whereHas('fund_request')->with('estate', 'provider')
                ->whereDate(
                    'created_at',
                    '>=',

                    Carbon::parse($this->fromdate)->format('Y-m-d')
                )
                ->whereDate(
                    'created_at',
                    '<=',


                    Carbon::parse($this->todate)->format('Y-m-d')
                )
                ->get()
        ]);

    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 20,
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
