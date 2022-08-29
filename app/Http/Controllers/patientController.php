<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class patientController extends Controller
{
    public function list()
    {
        $patient = DB::table('patient')
            ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
            ->join('hcode','hcode.hcode','patient.patient_hcode')
            ->get();
        return view('patient.list',['patient'=>$patient]);
    }

    public function register()
    {
        $district = DB::table('district')->get();
        $province = DB::table('province')->get();
        $aumphur = DB::table('aumphur')->get();
        $sex = DB::table('p_sex')->get();
        $prefix = DB::table('p_prefix')->get();
        $hcode = DB::table('hcode')->get();
        $clinic = DB::table('clinic')->where('clinic_status',1)->get();

        return view('patient.register',['district'=>$district,'aumphur'=>$aumphur,
        'province'=>$province,'sex'=>$sex,'prefix'=>$prefix,'hcode'=>$hcode,'clinic'=>$clinic]);
    }

    public function newPatient(Request $request)
    {
        $validatedData = $request->validate(
            [
                'patient_hn' => 'required',
                'patient_pid' => 'required',
                'patient_prefix' => 'required',
                'patient_name' => 'required',
                'patient_gender' => 'required',
                'patient_dob' => 'required',
                'patient_tel' => 'required',
                'patient_hno' => 'required',
                'patient_hroad' => 'required',
                'patient_hmoo' => 'required',
                'patient_hmooname' => 'required',
                'patient_htambon' => 'required',
                'patient_aumphur' => 'required',
                'patient_province' => 'required',
                'patient_hcode' => 'required'
            ],
            [
                'patient_hn.required' => 'กรุณาระบุ HN',
                'patient_pid.required' => 'กรุณาระบุหมายเลข 13 หลัก',
                'patient_prefix.required' => 'กรุณาระบุคำนำหน้า',
                'patient_name.required' => 'กรุณาระบุชื่อผู้ป่วย',
                'patient_gender.required' => 'กรุณาระบุเพศ',
                'patient_dob.required' => 'กรุณาระบุวันเกิด',
                'patient_tel.required' => 'กรุณาระบุเบอร์โทรศัพท์',
                'patient_hno.required' => 'กรุณาระบุบ้านเลขที่',
                'patient_hroad.required' => 'กรุณาระบุถนน',
                'patient_hmoo.required' => 'กรุณาระบุหมู่',
                'patient_hmooname.required' => 'กรุณาระบุชื่อหมู่บ้าน',
                'patient_htambon.required' => 'กรุณาระบุตำบล',
                'patient_aumphur.required' => 'กรุณาระบุอำเภอ',
                'patient_province.required' => 'กรุณาระบุจังหวัด',
                'patient_hcode.required' => 'กรุณาระบุหน่วยบริการ'
            ],
        );

        $dob = substr($request->get('patient_dob'),4);
        $newYear = date("Y",strtotime($request->get('patient_dob')))-543;
        $newdob = $newYear.$dob;

        if($request->get('drug')){
            $arr_select = array();
            foreach($request->get('drug') as $drug){
                $arr_select[] = $drug;
            }
            $drugs = implode(" <br> ", $arr_select);
        }else{ $drugs = ""; }

        DB::table('patient')->insert(
            [
                "patient_hn" => $request->get('patient_hn'),
                "patient_prefix" => $request->get('patient_prefix'),
                "patient_gender" => $request->get('patient_gender'),
                "patient_name" => $request->get('patient_name'),
                "patient_dob" => $newdob,
                "patient_pid" => $request->get('patient_pid'),
                "patient_tel" => $request->get('patient_tel'),
                "patient_hno" => $request->get('patient_hno'),
                "patient_hroad" => $request->get('patient_hroad'),
                "patient_hmoo" => $request->get('patient_hmoo'),
                "patient_hmooname" => $request->get('patient_hmooname'),
                "patient_htambon" => $request->get('patient_htambon'),
                "patient_aumphur" => $request->get('patient_aumphur'),
                "patient_province" => $request->get('patient_province'),
                "patient_hcode" => $request->get('patient_hcode'),
                'patient_drug_allergy' => $drugs,
            ]
        );

        DB::table('patient_clinic')->insert(
            [
                "pc_hn" => $request->get('patient_hn'),
                "pc_date_start" => $request->get('pc_date_start'),
                "pc_hcode" => $request->get('patient_hcode'),
                "pc_clinic" => $request->get('patient_clinic'),
            ]
        );
        return redirect()->route('patient.list')->with('success','ลงทะเบียนผู้ป่วยใหม่สำเร็จ : HN '.$request->get('patient_hn')." ".$request->get('patient_name'));
    }

    public function showPatient($id)
    {
        $patient = DB::table('patient')
                ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
                ->join('p_sex','p_sex.sex_id','patient.patient_gender')
                ->join('hcode','hcode.hcode','patient.patient_hcode')
                ->join('district','district.dis_value','patient.patient_htambon')
                ->where('patient_id',$id)
                ->first();
                
        $pcn = DB::table('patient_clinic')
                ->join('patient','patient.patient_hn','patient_clinic.pc_hn')
                ->join('patient_status','patient_status.status_id','patient_clinic.pc_status')
                ->join('hcode','hcode.hcode','patient_clinic.pc_hcode')
                ->join('clinic','clinic.id','patient_clinic.pc_clinic')
                ->where('pc_hn',$patient->patient_hn)
                ->get();
        return view('patient.show',['patient'=>$patient,'pcn'=>$pcn]);
    }

    public function editPatient($id)
    {
        $patient = DB::table('patient')
                ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
                ->where('patient.patient_id', $id)
                ->first();
        $district = DB::table('district')->get();
        $province = DB::table('province')->get();
        $aumphur = DB::table('aumphur')->get();
        $sex = DB::table('p_sex')->get();
        $prefix = DB::table('p_prefix')->get();

        return view('patient.edit',['patient'=>$patient,'district'=>$district,'aumphur'=>$aumphur,
        'province'=>$province,'sex'=>$sex,'prefix'=>$prefix]);
    }

    public function updatePatient(Request $request, $id)
    {
        DB::table('patient')->where('patient_id', $id)->update(
            [
                "patient_prefix" => $request->get('patient_prefix'),
                "patient_gender" => $request->get('patient_gender'),
                "patient_name" => $request->get('patient_name'),
                "patient_dob" => $request->get('patient_dob'),
                "patient_tel" => $request->get('patient_tel'),
                "patient_hno" => $request->get('patient_hno'),
                "patient_hroad" => $request->get('patient_hroad'),
                "patient_hmoo" => $request->get('patient_hmoo'),
                "patient_hmooname" => $request->get('patient_hmooname'),
                "patient_htambon" => $request->get('patient_htambon'),
                "patient_aumphur" => $request->get('patient_aumphur'),
                "patient_province" => $request->get('patient_province'),
            ]
        );
        return back()->with('success','แก้ไขทะเบียนผู้ป่วยสำเร็จ HN: '.$request->get('patient_hn')." ".$request->get('patient_name'));
    }

    public function showCare($id)
    {         
        $patient = DB::table('patient_clinic')
                ->join('patient','patient.patient_hn','patient_clinic.pc_hn')
                ->join('p_prefix','p_prefix.prefix_value','patient.patient_prefix')
                ->join('patient_status','patient_status.status_id','patient_clinic.pc_status')
                ->join('hcode','hcode.hcode','patient_clinic.pc_hcode')
                ->join('clinic','clinic.id','patient_clinic.pc_clinic')
                ->where('pc_id',$id)
                ->first();
        $item = DB::table('item')->where('item_active',1)->get();
        $hcode = DB::table('hcode')->where('hcode','!=',$patient->hcode)->get();
        $visit = DB::table('patient_visit')
                ->where('visit_patient_care',$id)
                ->get();
        return view('patient.care',['patient'=>$patient,'item'=>$item,'visit'=>$visit,'hcode'=>$hcode]);
    }

    public function visit(Request $request,$id)
    {
        $validatedData = $request->validate(
            [
                'visit_date' => 'required',
                'visit_status' => 'required',
                'temp' => 'required',
                'bp' => 'required',
                'rr' => 'required',
                'hr' => 'required',
                'weight' => 'required',
                'height' => 'required',
                'bmi' => 'required',
                'osat' => 'required',
                'ccpi' => 'required',
                'psexam' => 'required',
                'visit_icd10' => 'required',
                'visit_item' => 'required',
            ],
        );

        if($request->get('visit_item')){
            $arr_select = array();
            foreach($request->get('visit_item') as $visit_item){
                $arr_select[] = $visit_item;
            }
            $visit_items = implode(",", $arr_select);
        }else{
            $visit_items = "";
        }

        $vital = $request->get('temp').",".$request->get('bp').",".$request->get('rr').",".
        $request->get('hr').",".$request->get('weight').",".$request->get('height').",".$request->get('bmi').",".
        $request->get('osat');

        DB::table('patient_visit')->insert(
            [
                "visit_patient_care" => $id,
                "visit_date" => $request->get('visit_date'),
                "visit_patient_status" => $request->get('visit_status'),
                "visit_vital_sign" => $vital,
                "visit_ccpi" => $request->get('ccpi'),
                "visit_physical_ex" => $request->get('psexam'),
                "visit_dx" => $request->get('visit_icd10'),
                "visit_order" => $visit_items,
                "visit_create" => '1',
            ]
        );
        return back()->with('success','บันทึกข้อมูลการติดตามสำเร็จ');
    }

    public function transfer(Request $request,$id)
    {
        $validatedData = $request->validate(
            [
                'visit_end' => 'required',
                'patient_hcode' => 'required',
                'note' => 'required',
            ],
        );

        $res = DB::table('patient_clinic')->where('pc_id',$id)->first();
        $patient = DB::table('patient')->where('patient_hn',$res->pc_hn)->first();

        DB::table('patient_clinic')->where('pc_id', $id)->update(
            [
                "pc_date_end" => $request->get('visit_end'),
                "pc_status" => 5,
            ]
        );

        DB::table('patient_clinic')->insert(
            [
                "pc_hn" => $patient->patient_hn,
                "pc_date_start" => $request->get('visit_end'),
                "pc_hcode" => $request->get('patient_hcode'),
                "pc_clinic" => $res->pc_clinic,
            ]
        );

        $last = DB::table('patient_clinic')->orderBy('pc_id','desc')->first();
        DB::table('transfer')->insert(
            [
                "tran_pc_id" => $last->pc_id,
                "tran_send" => 1,
            ]
        );

        return back()->with('success','ส่งต่อผู้ป่วยสำเร็จ : HN '.$patient->patient_hn." ".$patient->patient_name);
    }
}
