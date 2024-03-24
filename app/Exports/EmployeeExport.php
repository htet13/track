<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class EmployeeExport implements FromView, WithColumnFormatting, WithEvents
{
   protected $employees;

	public function __construct($employees) 
	{
		$this->employees = $employees;	
	}

    /**
    * @return View
    */
    public function view(): View
    {
    	return view('exports.employee', [
    		'employees' => $this->employees
    	]);
    }

    public function columnFormats(): array
    {
        return [
            // Add your column formats if needed
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set column widths
                $event->sheet->getColumnDimension('A')->setWidth(5); // Assuming 'A' is the first column
                $event->sheet->getColumnDimension('B')->setWidth(20); // Assuming 'B' is the second column
                $event->sheet->getColumnDimension('C')->setWidth(20);  
                $event->sheet->getColumnDimension('D')->setWidth(20);  

                // Set static row height for all rows
                $event->sheet->getDefaultRowDimension()->setRowHeight(50);

                $event->sheet->getStyle('A:D')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                ]);

            },
        ];
    }
}
