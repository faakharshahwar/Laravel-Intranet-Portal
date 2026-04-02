<?php

namespace App\Imports;

use App\Models\Modules\ManagementReviews;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class ManagementReviewsImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ManagementReviews([
            'date_of_management_review' => $row['date_of_management_review'],
            'site' => $row['site'],
            'status' => $row['status'],
            'agenda' => $row['agenda'],
            'minutes_attachment' => $row['minutes_attachment'],
            'attachment_1' => $row['attachment_1'],
            'attachment_2' => $row['attachment_2'],
            'attachment_3' => $row['attachment_3'],
            'comments' => $row['comments'],
        ]);
    }
}
