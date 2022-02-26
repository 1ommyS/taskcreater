<?php


namespace App\Repositories\Implementations;


use App\Repositories\Interfaces\IPremiumRepository;
use Illuminate\Support\Facades\DB;

class PremiumRepository implements IPremiumRepository
{
    public function getSumPremiumOnPeriodForTeacher ($teacher_id,string $start, string $end): int
    {
        $premiums = DB::table("premiums")->where([
            [
                "teacher_id",
                $teacher_id
            ],
            [
             "created_at",
                ">=",
                $start . " 00:00:00"
            ],
            [
             "created_at",
                "<=",
                $end . " 23:59:00"
            ]
        ])->sum("value");
        return $premiums;
    }
    public function getSumPremiumOnPeriod (string $start, string $end): int
    {
        $premiums = DB::table("premiums")->where([
            [
             "created_at",
                ">=",
                $start . " 00:00:00"
            ],
            [
             "created_at",
                "<=",
                $end . " 23:59:00"
            ]
        ])->sum("value");
        return $premiums;
    }
}