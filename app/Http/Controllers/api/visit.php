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
                ->join('users','users.user_id','patient_visit.visit_create')
                ->where('visit_id',$id)
                ->first();
        $ods = $result->visit_order;
        $vital = (explode(",",$result->visit_vital_sign));
        $order = DB::select(DB::raw("select * from item where item_id in ($ods)"));

        return Response::json(array(
            'result' => $result,
            'vital' => $vital,
            'order' => $order,
        ));
    }
}
