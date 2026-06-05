<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResultsExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $results;

    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    public function collection(): Collection
    {
        return $this->results;
    }

    public function headings(): array
    {
        return [
            'Position',
            'Candidate Name',
            'College',
            'Partylist',
            'Votes',
        ];
    }

    public function map($candidate): array
    {
        return [
            $candidate->position->name ?? 'No Position',
            $candidate->full_name,
            $candidate->college,
            $candidate->partylist ?? '—',
            $candidate->total_votes ?? 0,
        ];
    }
}