<?php

namespace App\Imports;

use App\Models\Modules\ExternalDocument;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExternalDocumentImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ExternalDocument([
            'id' => $row['id'] ?? '-',
            'site' => $row['site'] ?? '-',
            'doc_id' => $row['doc_id'] ?? '-',
            'document_type' => $row['document_type'] ?? '-',
            'organization' => $row['organization'] ?? '-',
            'title' => $row['title'] ?? '-',
            'effective_date' => $row['effective_date'] ?? '-',
            'verification_date' => $row['verification_date'] ?? '-',
            'verification_method' => $row['verification_method'] ?? '-',
            'verified_by' => $row['verified_by'] ?? '-',
            'next_verification_due_date' => $row['next_verification_due_date'] ?? '-',
            'primary_location_held' => $row['primary_location_held'] ?? '-',
            'attachment' => $row['attachment'] ?? '-',
            'web_linked_file' => $row['web_linked_file'] ?? '-',
            'comments' => $row['comments'] ?? '-',
            'created_at' => $row['created_at'] ?? '-',
            'updated_at' => $row['updated_at'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            'doc_id' => \Illuminate\Validation\Rule::unique('external_documents', 'doc_id'),
        ];
    }
}
