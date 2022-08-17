<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class clinicController extends Controller
{
    public function index()
    {
        $clinic = DB::table('clinic')->get();
        return view('config.clinic.index',['clinic'=>$clinic]);
    }

    public function addClinic(Request $request)
    {
        $validatedData = $request->validate(
            [
                'clinic_name' => 'required',
                'clinic_sname' => 'required'
            ],
            [
                'clinic_name.required' => 'กรุณาระบุชื่อคลินิก',
                'clinic_sname.required' => 'กรุณาระบุชื่อย่อคลินิก'
            ],
        );

      
        DB::table('clinic')->insert(
            [
                "clinic_name" => $request->get('clinic_name'),
                "clinic_sname" => $request->get('clinic_sname'),
            ]
        );
        return back()->with('success','เพิ่มรายการคลินิกใหม่สำเร็จ '.$request->get('clinic_sname')." : ".$request->get('clinic_name'));
    }

    public function clinicStatus(Request $request)
    {
        $id = $request->get('id');
        $stat = $request->get('status');
        DB::table('clinic')->where('id', $id)->update(
            [ 'clinic_status' => $stat ]
        );
    }
}
