<?php

namespace App\Exports;

use App\Services\UserService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class InvoicesExport implements FromCollection, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'invoices.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return (new UserService())->getUserInvoices(Auth::user());
    }

    public function headings(): array
    {
        return [
            'Date',
            'Amount',
            'Plan',
            'Stripe Number'
        ];
    }

    /**
     * @param Invoice $invoice
     */
    public function map($invoice): array
    {
        return [
            $invoice->iso_created,
            '$' . $invoice->amount,
            $invoice->plan_name,
            $invoice->number,
        ];
    }

}
