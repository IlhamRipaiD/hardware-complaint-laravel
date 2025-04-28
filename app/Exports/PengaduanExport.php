<?php

namespace App\Exports;

use App\Models\InsertModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengaduanExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
    $this->startDate = date('Y-m-d', strtotime($startDate));
    $this->endDate = date('Y-m-d', strtotime($endDate));
    }

    public function collection()
    {
    return InsertModel::whereBetween('created_at', [
        $this->startDate . ' 00:00:00', 
        $this->endDate . ' 23:59:59'
    ])->get();
    }

    public function map($pengaduan): array
    {
    return [
        $pengaduan->unit_ruangan,
        $pengaduan->nama,
        $pengaduan->media,
        $pengaduan->masalah,
        $pengaduan->kategori,
        $pengaduan->detail_masalah,
        $pengaduan->solusi,
        $pengaduan->status,
        $pengaduan->created_at->format('d/m/Y H:i:s'),
        $pengaduan->updated_at->format('d/m/Y H:i:s'),
    ];
    }
    
    public function headings(): array
    {
        return [
            'Unit Ruangan',
            'Nama',
            'Media',
            'Masalah',
            'Kategori',
            'Detail Masalah',
            'Solusi',
            'Status',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:J1' => [
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'CCCCCC']],
                'font' => ['bold' => true]
            ],
            'A1:J'.$sheet->getHighestRow() => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->freezePane('A2');
            },
        ];
    }
}