@extends('layouts.app')
@section('content')
<style>
    .select2-selection__rendered {
        line-height: 38px !important;
    }
    .select2-container .select2-selection--single {
        height: 39px !important;
    }
    .select2-selection__arrow {
        height: 38px !important;
    }
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="h6 text-gray-800">
            Watchan Patient Care : โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
        </h5>
        <nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ url('patient') }}">ทะเบียนผู้ป่วย</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $patient->patient_hn }}</li>
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
                                <i class="fa-solid fa-user-circle"></i> {{ $patient->patient_hn." ".$patient->patient_name }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('patient.update',$patient->patient_id) }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input id="hn" name="patient_hn" type="text" class="form-control font-weight-bold"
                                        value="{{ $patient->patient_hn }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">
                                <i class="fa-solid fa-address-card"></i>
                                    หมายเลขบัตรประชาชน
                                </label>
                                <input type="text" id="patient_pid" name="patient_pid" class="form-control font-weight-bold"
                                    value="{{ $patient->patient_pid }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">คำนำหน้า</label>
                                <select id="patient_prefix" name="patient_prefix" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($prefix as $res)
                                        <option value="{{ $res->prefix_value }}"
                                            {{ ($patient->patient_prefix == $res->prefix_value) ? 'SELECTED' : '' }}>
                                            {{ $res->prefix_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ชื่อ-สกุล</label>
                                <input type="text" id="patient_name" name="patient_name" class="form-control" value="{{ $patient->patient_name }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เพศ</label>
                                <select id="patient_gender" name="patient_gender" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($sex as $res)
                                        <option value="{{ $res->sex_id }}"
                                            {{ ($patient->patient_gender == $res->sex_id) ? 'SELECTED' : '' }}>
                                            {{ $res->sex_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">วันเกิด</label>
                                <input type="text" id="patient_dob" name="patient_dob" class="form-control basicDate" value="{{ $patient->patient_dob }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">โทรศัพท์</label>
                                <input type="text" id="patient_tel" name="patient_tel" class="form-control" pattern="[0-9]" maxlength="10" value="{{ $patient->patient_tel }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">บ้านเลขที่</label>
                                <input type="text" id="patient_hno" name="patient_hno" class="form-control" value="{{ $patient->patient_hno }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ถนน</label>
                                <input type="text" id="patient_hroad" name="patient_hroad" class="form-control" value="{{ $patient->patient_hroad }}">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">หมู่ที่</label>
                                <input type="text" id="patient_hmoo" name="patient_hmoo" class="form-control" value="{{ $patient->patient_hmoo }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">ชื่อหมู่บ้าน</label>
                                <input type="text" id="patient_hmooname" name="patient_hmooname" class="form-control" value="{{ $patient->patient_hmooname }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">ตำบล</label>
                                <select id="patient_htambon" name="patient_htambon" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($district as $res)
                                        <option value="{{ $res->dis_value }}"
                                            {{ ($patient->patient_htambon == $res->dis_value) ? 'SELECTED' : '' }}>
                                            {{ $res->dis_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">อำเภอ</label>
                                <select id="patient_aumphur" name="patient_aumphur" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($aumphur as $res)
                                        <option value="{{ $res->aum_value."00" }}"
                                            {{ ($patient->patient_aumphur == $res->aum_value."00") ? 'SELECTED' : '' }}>
                                            {{ $res->aum_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">จังหวัด</label>
                                <select id="patient_province" name="patient_province" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($province as $res)
                                        <option value="{{ $res->pro_code."0000" }}"
                                            {{ ($patient->patient_province == $res->pro_code."0000") ? 'SELECTED' : '' }}>
                                            {{ $res->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-right" style="margin-top: 1rem;">
                            <button type="button" class="btn btn-success" onclick="Swal.fire({
                                    title: 'แก้ไขทะเบียนผู้ป่วย ?',
                                    showCancelButton: true,
                                    confirmButtonText: `<i class='fa-solid fa-folder-plus'></i> ยืนยัน`,
                                    cancelButtonText: `<i class='fa-regular fa-times-circle'></i> ยกเลิก`,
                                    icon: 'success',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">
                                <i class="fa-solid fa-save"></i> แก้ไข
                            </button>
                            <a href="{{ url('/patient/'.$patient->patient_id.'') }}"
                                class="btn btn-danger">
                                <i class="fa-solid fa-times-circle"></i> ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
