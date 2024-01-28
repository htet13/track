<?

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TrackExport implements FromView, WithColumnFormatting, WithEvents
{
    protected $tracks;

    public function __construct($tracks)
    {
        $this->tracks = $tracks;
    }

    public function view(): View
    {
        return view('exports.track', [
            'tracks' => $this->tracks
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
                $event->sheet->getColumnDimension('A')->setWidth(5); 
                $event->sheet->getColumnDimension('B')->setWidth(20); 
                $event->sheet->getColumnDimension('C')->setWidth(20); 
                $event->sheet->getColumnDimension('D')->setWidth(10); 
                $event->sheet->getColumnDimension('E')->setWidth(20); 
                $event->sheet->getColumnDimension('F')->setWidth(20); 

                // Set static row height for all rows
                $event->sheet->getDefaultRowDimension()->setRowHeight(25);

                // Center data horizontally and vertically in cells
                $event->sheet->getStyle('A:F')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
