@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="h6 text-gray-800">
            Watchan Patient Care : โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
        </h5>
        <nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('patient') }}">ทะเบียนผู้ป่วย</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $patient->patient_hn }}</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <i class="fa-solid fa-user-circle"></i>
                ข้อมูลผู้ป่วย
            </h6>
        </div>
        <div class="card-body" style="font-size: 14px;">
            <div class="row">
                <div class="col-md-4">
                    @if ($patient->patient_gender == 1)
                    <img src="{{ asset('img/undraw_profile_2.svg') }}" class="img img-fluid">
                    @else
                    <img src="{{ asset('img/undraw_profile_1.svg') }}" class="img img-fluid">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>HN</th>
                            <td>{{ $patient->patient_hn }}</td>
                        </tr>
                        <tr>
                            <th>CID</th>
                            <td>{{ $patient->patient_pid }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อ - สกุล</th>
                            <td>{{ $patient->prefix_name.$patient->patient_name }}</td>
                        </tr>
                        <tr>
                            <th>เพศ</th>
                            <td>{{ $patient->sex_name }}</td>
                        </tr>
                        <tr>
                            <th>วันเกิด</th>
                            <td>{{ DateThai($patient->patient_dob) }}</td>
                        </tr>
                        <tr>
                            <th>อายุ</th>
                            <td>{{ GetAge($patient->patient_dob)." ปี" }}</td>
                        </tr>
                        <tr>
                            <th>เบอร์โทร</th>
                            <td>{{ $patient->patient_tel }}</td>
                        </tr>
                        <tr>
                            <th>ที่อยู่</th>
                            <td>
                                <span>
                                {{ 
                                    "บ้านเลขที่ ".$patient->patient_hno." ถนน".$patient->patient_hroad." ตำบล".$patient->dis_name
                                    ." หมู่ ".$patient->patient_hmoo." หมู่บ้าน".$patient->patient_hmooname 
                                }}
                                </span>
                                <br>
                                <a href="#" class="badge badge-danger">
                                    <i class="fa-solid fa-location-arrow"></i>
                                    แผนที่ GPS
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div class="text-right">
                        <a href="{{ route('patient.edit',$patient->patient_id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-regular fa-edit"></i>
                            แก้ไขข้อมูล
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <i class="fa-solid fa-list-check"></i>
                รายการติดตามผู้ป่วย
            </h6>
        </div>
        <div class="card-body" style="font-size: 14px;">
           <table id="tableBasic" class="table table-borderless table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">วันที่เริ่มติดตาม</th>
                        <th>หน่วยบริการที่ดูแล</th>
                        <th>คลินิก</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach ($pcn as $res)
                    @php $i++; @endphp
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center">{{ DateThai($res->pc_date_start) }}</td>
                        <td>{{ $res->hcode." : ".$res->hname }}</td>
                        <td>{{ $res->clinic_sname." : ".$res->clinic_name }}</td>
                        <td class="text-center">
                            <i class="{{ $res->status_icon." ".$res->status_color }}"></i>
                            {{ $res->status_name }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('patient.care',$res->pc_id) }}" class="btn btn-info btn-sm">
                                <i class="fa-solid fa-search"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
           </table>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
