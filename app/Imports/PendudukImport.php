<?php

namespace App\Imports;

use App\Models\Penduduk;
use App\Models\KartuKeluarga;
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
use Hash;

class PendudukImport implements ToModel, WithHeadingRow, WithValidation
{

    // use SkipsErrors, SkipsFailures;

    public function rules(): array
    {
        return [
            'nik' => 'unique:penduduk,nik',
            'rt' => 'required',
            'rw' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'alamat_lengkap' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'pendidikan' => 'required',
            'jenis_pekerjaan' => 'required',
            // 'status_keluarga' => 'required',
            'status_perkawinan' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
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
        KartuKeluarga::firstOrCreate([
            'nomor_kk' => $row['nomor_kk']
        ]);
        return new Penduduk([
            'nik' => $row['nik'],
            'nama' => ucfirst(strtolower($row['nama_lengkap'])),
            'nomor_kk' => $row['nomor_kk'],
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir' => ucfirst(strtolower($row['tempat_lahir'])),
            'jenis_kelamin' => ucfirst(strtolower($row['jenis_kelamin'])),
            'alamat' => ucfirst(strtolower($row['alamat_lengkap'])),
            'kelurahan' => ucfirst(strtolower($row['kelurahan'])),
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'agama' => ucfirst(strtolower($row['agama'])),
            'pendidikan' => ucfirst(strtolower($row['pendidikan'])),
            'pekerjaan' => ucfirst(strtolower($row['jenis_pekerjaan'])),
            'golongan_darah' => $row['golongan_darah'],
            'status_keluarga' => ucfirst(strtolower($row['status_pada_keluarga'])),
            'status_perkawinan' => ucfirst(strtolower($row['status_perkawinan'])),
            'kewarganegaraan' => $row['kewarganegaraan'],
            'ayah' => $row['nama_ayah'],
            'ibu' => $row['nama_ibu'],
            'password' => Hash::make(strtolower(str_replace(' ', '', $row['tempat_lahir'])).Carbon::parse($tanggal_lahir)->format('dmY')),
            'kategori_penduduk' => $row['kategori_penduduk'],
        ]);
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

    public function uniqueBy()
    {
        return 'nik';
    }
}