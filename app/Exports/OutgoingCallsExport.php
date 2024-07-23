<?php

namespace App\Exports;

use App\Models\Outgoingcalls;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class OutgoingCallsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Outgoingcalls::select('id', 'branchcalled', 'drug', 'response', 'branchthatcalled', 'created_at')->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Branch Called',
            'Drug Requested',
            'Response',            
            'Branch Called From',            
            'Date'
        ];
    }
}
