<?php

namespace App\Exports;

use App\Models\Modules\CalibratedDevices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CalibratedDevicesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'ID',
            'Device ID',
            'Calibration Device Front Image',
            'Calibration Device Back Image',
            'Site',
            'Calibration Category',
            'Calibration Report',
            'Calibration Supplier',
            'Serial No',
            'Device Description',
            'Manufacturer',
            'Model',
            'Location',
            'Calibration Type',
            'Calibration Frequency',
            'Accuracy Required',
            'Standards Used',
            'Method of Calibration',
            'Readings - Nominal Values',
            'Readings - Actual Values 1',
            'Readings - Actual Values 2',
            'Readings - Actual Values 3',
            'Readings - Corrected Values',
            'Date Last Calibrated',
            'Next Calibration Due Date',
            'Temperature',
            'Temp Unit',
            'Humidity',
            'Calibrated By',
            'Approved By',
            'Device Status',
            'Calibration Status',
            'TP Calibrated Results As Found',
            'TP Calibrated Results As Left',
            'Attachment',
            'NCR',
            'Comments',
            'Past Year',
            'Created By',
            'Updated By',
            'Created At',
            'Updated At'
        ];
    }

    public function collection()
    {
        return CalibratedDevices::all();
    }
}
