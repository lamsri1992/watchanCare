<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class diagController extends Controller
{
    public function all(Request $request){
        $search = $request->search;

        if($search == ''){
        $diag = DB::table('icd10')->limit(5)->get();
        }else{
        $diag = DB::table('icd10')
                ->where('icd10_number', 'like', '%' .$search . '%')
                ->orwhere('icd10_description', 'like', '%' .$search . '%')
                ->limit(5)->get();
        }

        $response = array();
        foreach($diag as $res){
        $response[] = array(
                "id"=>$res->id,
                "text"=>$res->icd10_number." : ".$res->icd10_description
            );
        }
        return response()->json($response);
    }
}
