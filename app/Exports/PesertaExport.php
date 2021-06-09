<?php

namespace App\Exports;
namespace App\Exports;

use App\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesertaExport implements FromCollection, WithHeadings, WithMapping
{
	public function headings(): array
    {
        return [
            'NIS',
            'Nama Lengkap',
            'Tempat Prakerin',
            'Kelas',
            'Tanggal Prakerin'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peserta::select('nis','nama_lengkap','perusahaan_id','grup_id','tanggal_mulai','tanggal_selesai')->where('perusahaan_id', '!=', NULL)->get();
    }

    public function map($peserta): array
    {
        return [
            $peserta->nis,
            $peserta->nama_lengkap,
            $peserta->perusahaan->nama_perusahaan,
            $peserta->grup->kelas,
            $peserta->tgl()
        ];
    }
}
