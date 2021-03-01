<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'apaterno' => $row[1],
            'amaterno' => $row[2],
            'email' => $row[3],
            'birthday' => $row[4],
            'gender' => $row[5],
            'marital' => $row[6],
            'education' => $row[7],
            'job' => $row[8],
            'department' => $row[9],
            'hiring_type' => $row[10],
            'turn' => $row[11],
            'rotation' => $row[12],
            'current_work_exp' => $row[13],
            'work_exp' => $row[14]
        ]);
    }
}
