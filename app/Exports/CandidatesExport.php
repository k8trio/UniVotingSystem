<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CandidatesExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $candidates;

    public function __construct(Collection $candidates)
    {
        $this->candidates = $candidates;
    }

    public function collection(): Collection
    {
        return $this->candidates;
    }

    public function headings(): array
    {
        return [
            'Position',
            'Last Name',
            'First Name',
            'Full Name',
            'College',
            'Partylist',
            'Status',
        ];
    }

    public function map($candidate): array
    {
        return [
            $candidate->position->name ?? 'No Position',
            $candidate->last_name,
            $candidate->first_name,
            $candidate->full_name,
            $candidate->college,
            $candidate->partylist,
            $candidate->is_active ? 'Active' : 'Inactive',
        ];
    }
}