<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VotersExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $voters;

    public function __construct(Collection $voters)
    {
        $this->voters = $voters;
    }

    public function collection(): Collection
    {
        return $this->voters;
    }

    public function headings(): array
    {
        return [
            'Student ID',
            'Last Name',
            'First Name',
            'College',
            'Program',
            'Year and Section',
            'Status',
            'Voted At',
        ];
    }

    public function map($voter): array
    {
        return [
            $voter->student_id,
            $voter->last_name,
            $voter->first_name,
            $voter->college,
            $voter->program,
            $voter->year_and_section,
            $voter->has_voted ? 'Voted' : 'Not Yet',
            $voter->voted_at,
        ];
    }
}