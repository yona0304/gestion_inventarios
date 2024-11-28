<?php

namespace App\Exports;

use App\Models\HistorialComputo;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistorialExport implements FromView, WithEvents, WithStyles
{
    private $fecha_inicial;
    private $fecha_final;

    public function __construct($fecha_inicial, $fecha_final)
    {
        $this->fecha_inicial = $fecha_inicial;
        $this->fecha_final = $fecha_final;
    }

    public function view(): View
    {
        $fecha_inicial = Carbon::parse($this->fecha_inicial);
        $fecha_final = Carbon::parse($this->fecha_final);

        $historiales = HistorialComputo::with('producto')->whereBetween('fecha_registro', [$fecha_inicial, $fecha_final])
            ->orderBy('fecha_registro')
            ->get();

        return view('historialsheet', [
            'historiales'       => $historiales,
            'fecha_inicial'     => $fecha_inicial,
            'fecha_final'       => $fecha_final,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajustar el tamaño de las columnas
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(40);
                $sheet->getColumnDimension('D')->setWidth(60);
                $sheet->getColumnDimension('E')->setWidth(25);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(25);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(25);
                $sheet->getColumnDimension('J')->setWidth(25);
                $sheet->getColumnDimension('K')->setWidth(35);
                $sheet->getColumnDimension('L')->setWidth(60);
                $sheet->getColumnDimension('M')->setWidth(60);
                $sheet->getColumnDimension('N')->setWidth(25);
                $sheet->getColumnDimension('O')->setWidth(35);
                $sheet->getColumnDimension('P')->setWidth(35);
                $sheet->getColumnDimension('Q')->setWidth(35);
                $sheet->getColumnDimension('R')->setWidth(35);
                $sheet->getColumnDimension('S')->setWidth(35);
                $sheet->getColumnDimension('T')->setWidth(35);



                // Aplicar estilos a las celdas
                $sheet->getStyle('A1:T1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Aplicar estilos a las celdas del cuerpo
        $sheet->getStyle('A2:T1000')->applyFromArray([
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}
