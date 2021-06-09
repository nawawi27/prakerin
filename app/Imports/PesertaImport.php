<?php

namespace App\Imports;

use App\User;
use App\Peserta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PesertaImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 1) {
                // Insert Table User
                $user  = new User;
                $user->nama_lengkap = $row[1];
                $user->username = $row[0];
                $user->password = bcrypt('rahasia');
                $user->role = 'peserta';
                $user->path = 'default.png';
                $user->save();

                $uid = $user->id;

                // Insert Table Peserta
                Peserta::create([
                    'user_id' => $uid,
                    'grup_id' => $row[3],
                    'nis' => $row[0],
                    'nama_lengkap' => $row[1],
                    'jk' => $row[2],
                    'status' => 0
                ]);
            }
        }
    }
}
