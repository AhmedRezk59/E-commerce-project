<?php

namespace App\Exports;

use App\Models\Admin;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;


class AdminsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Admin::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'User Name',
            'E-Mail',
        ];
    }
    public function map($admin): array
    {
        return [
            $admin->id,
            $admin->name,
            $admin->email,
        ];
    }
}
