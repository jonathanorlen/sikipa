<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Carbon;

class PendudukImport implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError
{

    use SkipsErrors, SkipsFailures;

    public function rules(): array
    {
        return [
            'nik' => 'unique:penduduk,nik',
            'rt' => 'required',
            'rw' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'required' => 'Data pada baris ke',
            'in' => 'Data pada baris ke',
            'nik.unique' => 'NIK Telah dipakai',
            'rt.required' => 'Wajib Menyertakan Nomor RT',
            'rw.required' => 'Wajib Menyertakan Nomor RT',
            'jenis_kelamin.required' => 'Wajib Menyertakan Jenis Kelamin',
            'jenis_kelamin.in' => 'Tidak dalam Pilihan: Laki-Laki/Perempuan',
            'agama.required' => 'Wajib Menyertakan Agama',
            'agama.in' => 'Tidak dalam Pilihan:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
        ];
    }

    public function model(array $row)
    {   
        $tanggal_lahir = $this->transformDate($row['tanggal_lahir']);
        return new Penduduk([
            'nik' => $row['nik'],
            'nama' => $row['nama_lengkap'],
            'nomor_kk' => $row['nomor_kk'],
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => $row['tempat_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'umur' => Carbon::parse($tanggal_lahir)->age,
            'alamat' => $row['alamat_lengkap'],
            'kelurahan' => $row['kelurahan'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'agama' => $row['agama'],
            'pendidikan' => $row['pendidikan'],
            'pekerjaan' => $row['jenis_pekerjaan'],
            'golongan_darah' => $row['golongan_darah'],
            'status_keluarga' => $row['status_pada_keluarga'],
            'status_perkawinan' => $row['status_perkawinan'],
            'kewarganegaraan' => $row['kewarganegaraan'],
            'ayah' => $row['nama_ayah'],
            'ibu' => $row['nama_ibu'],
            'kategori_penduduk' => $row['kategori_penduduk'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
