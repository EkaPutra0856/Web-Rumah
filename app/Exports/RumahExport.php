<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RumahExport implements FromView, WithStyles
{
    protected $rumah;

    public function __construct($rumah)
    {
        $this->rumah = $rumah;
    }

    public function view(): View
    {
        return view('Rumah.excel', [
            'rumah' => $this->rumah
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya untuk header (baris pertama)
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF']
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FFADD8E6'] // Warna biru muda
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Teks di tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ];

        // Gaya untuk sel selain header
        $cellStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Teks di tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ];

        // Menerapkan gaya header ke baris pertama
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Menerapkan gaya sel ke seluruh kolom (A-D)
        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->applyFromArray($cellStyle);

        // Mengatur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);

        return [];
    }
}