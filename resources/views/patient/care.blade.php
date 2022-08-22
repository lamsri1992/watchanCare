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
                <li class="breadcrumb-item"><a href="{{ url('patient') }}">ทะเบียนผู้ป่วย</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/patient/'.$patient->patient_id.'') }}">{{ $patient->patient_hn }}</a></li>
                <li class="breadcrumb-item active">รายการติดตามผู้ป่วย</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-xs font-weight-bold text-success mb-1">
                                            <i class="fa-solid fa-address-card"></i>
                                            ผู้ป่วย {{ "HN:".$patient->patient_hn }}
                                        </div>
                                        {{ $patient->prefix_name.$patient->patient_name }}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-xs font-weight-bold text-success mb-1">
                                            <i class="fa-solid fa-list-check"></i>
                                            รายการติดตามผู้ป่วย
                                        </div>
                                        {{ $patient->clinic_sname." : ".$patient->clinic_name }}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-xs font-weight-bold text-success mb-1">
                                            <i class="fa-solid fa-house-medical"></i>
                                            หน่วยบริการที่ดูแล
                                        </div>
                                        {{ $patient->hcode." : ".$patient->hname }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-stethoscope fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-normal text-secondary">
                        <i class="fa-solid fa-list-check"></i>
                        การนัดหมายติดตามผู้ป่วย
                    </h6>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addNew">
                            <i class="fa-solid fa-calendar-plus"></i>
                            เพิ่มรายการติดตาม
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-people-arrows"></i>
                            ส่งต่อการรักษาผู้ป่วย
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-clipboard-check"></i>
                            Discharge
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" style="font-size: 14px;">
            <div class="tab-vertical">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-vertical-tab" data-toggle="tab" href="#home-vertical"
                            role="tab" aria-controls="home" aria-selected="true">
                            <i class="fa-regular fa-calendar-check"></i>
                            1 ส.ค. 2565
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent3">
                    <div class="tab-pane fade show active" id="home-vertical" role="tabpanel"
                        aria-labelledby="home-vertical-tab">
                        <p class="lead">
                            <i class="fa-regular fa-clipboard"></i>
                            ผู้ติดตามการเยี่ยม : นายวัดจันทร์ กัลยา (พยาบาลวิชาชีพ ปฏิบัติการ)
                        </p>
                        <p>
                            อาการเมาค้าง เป็นภาวะหรืออาการที่คล้ายกับไข้หวัดใหญ่ คือ การที่ร่างกายขาดน้ำ
                            เป็นผลที่เกิดหลังจากการดื่มเครื่องดื่มแอลกอฮอล์ในปริมาณที่มากเกินร่างกายจะสามารถรับได้
                            ส่งผลให้เสียสมดุลของฮอร์โมน เกิดการเปลี่ยนแปลงของสารสื่อประสาท และสารทางชีวภาพอื่นๆ ในร่างกาย
                        </p>
                        <p>
                            อาการเมาค้างโดยทั่วไป ได้แก่ ปวดหัว มึนหัว เวียนศีรษะ คอแห้ง ผิวหน้าแห้ง ริมฝีปากแห้ง หน้าบวม ตาบวมผื่นแดง
                            รอยแดง หน้าซีดเซียว คลื่นเหียน คลื่นไส้ อาเจียน ปวดท้อง ท้องขึ้น ท้องเฟ้อ หรือท้องร่วง ถ่ายเหลว รับประทานอาหารไม่ได้
                            เบื่ออาหาร นอนไม่ได้ สะลึมสะลือ กระเพาะอาหารเกิดการระคายเคือง มือสั่น ใจสั่น เหนื่อย เหงื่อออก หรืออ่อนเพลีย หมดแรงลุกไม่ขึ้น
                            ตัวเย็น กล้ามเนื้อเกร็ง (ตะคริว) ความดันโลหิตลดลง และรู้สึกไม่สบาย สะดุ้ง ตกใจง่าย
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNew" aria-labelledby="addNewLabel" aria-hidden="true">
    <form action="#">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">
                        <i class="fa-solid fa-calendar-plus"></i>
                        เพิ่มรายการติดตาม
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">
                                <i class="fa-solid fa-calendar-check"></i>
                                วันที่ติดตามเยี่ยม
                            </label>
                            <input type="text" id="visit_date" name="visit_date" class="form-control basicDate"
                                value="{{ old('visit_date') }}"
                                placeholder="เลือกวันที่" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">
                                สถานะผู้ป่วย
                            </label>
                            <select name="visit_status" class="custom-select">
                                <option>กรุณาเลือก</option>
                                <option value="">ผู้พิการ</option>
                                <option value="">ผู้สูงอายุ</option>
                                <option value="">ไม่ระบุ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                <i class="fa-solid fa-heart-pulse"></i>
                                Vital Sign
                            </label>
                            <table class="table table-borderless table-striped table-sm text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Temp</th>
                                        <th>BP</th>
                                        <th>RR</th>
                                        <th>HR</th>
                                        <th>น้ำหนัก</th>
                                        <th>ส่วนสูง</th>
                                        <th>BMI</th>
                                        <th>O2sat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                        <td>
                                            <input type="text" name="" class="form-control text-center"
                                            value="{{ old('') }}" placeholder="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                ประวัติการเจ็บป่วย
                            </label>
                            <textarea type="text" id="" name="" rows="3" class="form-control" value="{{ old('') }}"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                ประวัติการตรวจร่างกาย
                            </label>
                            <textarea type="text" id="" name="" rows="3" class="form-control" value="{{ old('') }}"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                การวินิจฉัย
                            </label>
                            <select id="visit_icd10" name="visit_icd10" class="basic-select2">
                                <option>กรุณาเลือก</option>
                                @foreach($icd10 as $res)
                                    <option value="{{ $res->id }}">{{ $res->icd10_number." : ".$res->icd10_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                รายการตรวจรักษา
                            </label>
                            <select id="visit_item" name="visit_item[]" class="basic-multiple" multiple="multiple">
                                <option>กรุณาเลือก</option>
                                @foreach($item as $res)
                                    <option value="{{ $res->item_id }}">{{ $res->item_common_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-save"></i>
                        บันทึกการติดตาม
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')

@endsection
