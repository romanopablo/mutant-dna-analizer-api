<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as Controller;
use DB;

class StatsController extends Controller
{
    public function getStats()
    {
        $data = DB::table('stats')->select('*')->first();

        return response()->json(
            array(
                'count_mutant_dna' => $data->count_mutant_dna,
                'count_human_dna'  => $data->count_human_dna,
                'ratio' => $data->ratio
            ),
            200
        );
    }
}
