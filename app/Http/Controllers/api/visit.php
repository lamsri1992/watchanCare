<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class visit extends Controller
{
    public function show($id)
    {
        $result = DB::table('patient_visit')
                ->join('icd10','icd10.id','patient_visit.visit_dx')
                ->where('visit_id',$id)
                ->first();
        $vital = (explode(",",$result->visit_vital_sign));
        $order = (explode(",",$result->visit_order));
        return Response::json(array(
            'result' => $result,
            'vital' => $vital,
            'order' => $order,
        ));
    }
}
