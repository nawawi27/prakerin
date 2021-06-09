<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Pembimbing;
use App\User;

class PembimbingImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 1) {
                // Insert Table User
                $user  = new User;
                $user->nama_lengkap = $row[0];
                $user->username = $row[0];
                $user->password = bcrypt('rahasia');
                $user->role = 'pembimbing';
                $user->path = 'default.png';
                $user->save();

                $uid = $user->id;

                // Insert Table Pembimbing
                Pembimbing::create([
                    'user_id' => $uid,
                    'nama_lengkap' => $row[0],
                    'tlp' => $row[1]
                ]);
            }
        }
    }
}
