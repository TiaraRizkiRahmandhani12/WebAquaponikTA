<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;

class DownloadDataExport implements FromView, WithHeadings
{
    protected $records;
    protected $chartId;

    public function __construct(Collection $records, $chartId)
    {
        $this->records = $records;
        $this->chartId = $chartId;
    }

    public function view(): View
    {
        return view('exports.download', [
            'records' => $this->records,
            'chartId' => $this->chartId,
        ]);
    }

    public function headings(): array
    {
        return ['Waktu', 'Data'];
    }
}
