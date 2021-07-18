<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendudukExport implements FromCollection, WithHeadings, WithColumnFormatting
{   
    
    public function __construct($data)
    {
        $this->agama = $data->agama ?? null;
        $this->pendidikan = $data->pendidikan ?? null;
        $this->status_keluarga = $data->status_keluarga ?? null;
        $this->pekerjaan = $data->pekerjaan ?? null;
        $this->kewarganegaraan = $data->kewarganegaraan ?? null;
        $this->jenis_kelamin = $data->jenis_kelamin ?? null;
        $this->umur_awal = $data->umur_awal ?? null;
        $this->umur_akhir = $data->umur_akhir ?? null;
    }
    
    public function collection()
    {   
        $penduduk = Penduduk::select(
            'nik',
            'nama',
            'nomor_kk',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'umur',
            'alamat',
            'kelurahan',
            'rt',
            'rw',
            'agama',
            'pendidikan',
            'pekerjaan',
            'golongan_darah',
            'status_keluarga',
            'status_perkawinan',
            'kewarganegaraan',
            'ayah',
            'ibu',
            'kategori_penduduk',
            'dokumen_kk',
            'dokumen_ktp',
        )->get();
        
        if($this->agama){
            $penduduk->where('agama','=',$this->agama);
        }

        if($this->pendidikan){
            $penduduk->where('pendidikan','=',$this->pendidikan);
        }

        if($this->status_keluarga){
            $penduduk->where('status_keluarga','=',$this->status_keluarga);
        }

        if($this->pekerjaan){
            $penduduk->where('pekerjaan','=',$this->pekerjaan);
        }

        if($this->kewarganegaraan){
            $penduduk->where('kewarganegaraan','=',$this->kewarganegaraan);
        }

        if($this->jenis_kelamin){
            $penduduk->where('jenis_kelamin','=',$this->jenis_kelamin);
        }
        if($this->umur_awal){
            $data->where('umur','>=',$req->umur_awal);
        }

        if($this->umur_akhir){
            $data->where('umur','<=',$req->umur_akhir);
        }
        return $penduduk;
    }

    public function headings():array{
        return ["NIK",
            "Nama",
            "Nomor Kartu Keluarga",
            "Tempat Lahir", 
            "Tanggal Lahir", 
            "Jenis Kelamin", 
            "Umur", 
            "Alamat", 
            "Kelurahan", 
            "RT", 
            "RW",
            "Agama",
            "Pendidikan",
            "Pekerjaan",
            "Golongan Darah",
            "Status Keluarga",
            "Status Perkawinan",
            "Kewarganegaraan",
            "Ayah",
            "Ibu",
            "Kategori Penduduk",
            "Dokumen KK",
            "Dokumen KTP",
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
