<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\StudentGroups;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model (array $row)
    {
        $group_id = Group::query()->where("name", $row[0])->first();
        $student_id = User::query()->where("name", $row[1])->first();
        return new StudentGroups([
            "group_id" => $group_id,
            "student_id" => $student_id,
        ]);
    }
}
