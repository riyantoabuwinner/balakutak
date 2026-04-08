<?php

namespace App\Imports;

use App\Models\Lecturer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Str;

class LecturersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        // Sanitize URLs
        $urlFields = [
            'google_scholar_url', 'sinta_url', 'garuda_url', 'linkedin_url', 'website_url'
        ];

        foreach ($urlFields as $field) {
            if (!empty($row[$field])) {
                $value = trim($row[$field]);
                if (!preg_match('~^(?:f|ht)tps?://~i', $value)) {
                    $row[$field] = 'https://' . $value;
                }
            }
        }

        return new Lecturer([
            'name' => $row['nama_lengkap'],
            'nip' => $row['nip'],
            'nidn' => $row['nidn'],
            'type' => strtolower($row['tipe_dosentendik']) === 'tendik' ? 'tendik' : 'dosen',
            'academic_title' => $row['jabatan_akademik'],
            'functional_position' => $row['jabatan_struktural'],
            'position' => $row['jabatan_umum'],
            'expertise' => $row['keahlian'],
            'education' => $row['pendidikan'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'google_scholar_url' => $row['google_scholar_url'],
            'sinta_url' => $row['sinta_url'],
            'garuda_url' => $row['garuda_url'],
            'linkedin_url' => $row['linkedin_url'],
            'website_url' => $row['website_url'],
            'biography' => $row['biografi'],
            'is_active' => true,
            'order' => Lecturer::max('order') + 1,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'tipe_dosentendik' => 'required|string',
            'google_scholar_url' => 'nullable|string|max:255',
            'sinta_url' => 'nullable|string|max:255',
            'garuda_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
        ];
    }
}
