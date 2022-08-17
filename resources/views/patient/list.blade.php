@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="h6 text-gray-800">
            Watchan Patient Care : โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
        </h5>
        <nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">ระบบติดตามผู้ป่วย</a></li>
              <li class="breadcrumb-item active" aria-current="page">ทะเบียนผู้ป่วย</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4" style="height: 100%;">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-normal text-secondary">
                                <i class="fa-regular fa-folder-open"></i> ทะเบียนผู้ป่วย
                            </h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ url('patient/register') }}" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-user-plus"></i> ลงทะเบียนผู้ป่วย
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableBasic" class="table table-borderless table-striped nowrap"
                    style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="1%">PATIENT : ID</th>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center"><i class="fa-regular fa-calendar-check"></i> วันที่ลงทะเบียน</th>
                                <th class="text-center">หน่วยบริการ</th>
                                <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient as $res)
                            <tr>
                                <td class="text-center">
                                    {{ str_pad($res->patient_id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="text-center">
                                    <a href="#" class="font-weight-bold">{{ $res->patient_hn }}</a>
                                </td>
                                <td>{{ $res->prefix_name.$res->patient_name }}</td>
                                <td class="text-center">{{ GetAge($res->patient_dob)." ปี" }}</td>
                                <td class="text-center">{{ DateThai($res->created_at) }}</td>
                                <td class="text-center">{{ $res->hname }}</td>
                                <td class="text-center">
                                    <a href="{{ route('patient.show',$res->patient_id) }}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection