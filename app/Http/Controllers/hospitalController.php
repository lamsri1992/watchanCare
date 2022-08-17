<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class hospitalController extends Controller
{
    public function index()
    {
        $hos = DB::table('hcode')->get();
        return view('config.hospital.index',['hos'=>$hos]);
    }

    public function addHospital(Request $request)
    {
        $validatedData = $request->validate(
            [
                'hcode' => 'required',
                'hname' => 'required',
                'haddress' => 'required'
            ],
            [
                'hcode.required' => 'กรุณาระบุรหัสหน่วยบริการ',
                'hname.required' => 'กรุณาระบุชื่อหน่วยบริการ',
                'haddress.required' => 'กรุณาระบุที่อยู่หน่วยบริการ'
            ],
        );

      
        DB::table('hcode')->insert(
            [
                "hcode" => $request->get('hcode'),
                "hname" => $request->get('hname'),
                "haddress" => $request->get('haddress'),
            ]
        );
        return back()->with('success','เพิ่มรายการหน่วยบริการใหม่สำเร็จ '.$request->get('hcode')." : ".$request->get('hname'));
    }

    public function hospitalStatus(Request $request)
    {
        $id = $request->get('id');
        $stat = $request->get('status');
        DB::table('hcode')->where('id', $id)->update(
            [ 'hstatus' => $stat ]
        );
    }
}
