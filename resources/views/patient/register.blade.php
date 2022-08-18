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
                <li class="breadcrumb-item active" aria-current="page">ลงทะเบียนผู้ป่วย</li>
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
                                <i class="fa-solid fa-user-plus"></i> ลงทะเบียนผู้ป่วย
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('patient.add') }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input id="hn" name="patient_hn" type="text" class="form-control"
                                        value="{{ old('patient_hn') }}"
                                        placeholder="ระบุหมายเลข HN 9 หลัก">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <a id="hn_find" type="button" style="font-size: 1rem;">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-search"></i> ค้นหา
                                                </small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">
                                <i class="fa-solid fa-address-card"></i>
                                    หมายเลขบัตรประชาชน
                                </label>
                                <input type="text" id="patient_pid" name="patient_pid" class="form-control"
                                    value="{{ old('patient_pid') }}"
                                    placeholder="ระบุหมายเลขบัตรประชาชน">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">คำนำหน้า</label>
                                <select id="patient_prefix" name="patient_prefix" class="custom-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($prefix as $res)
                                        <option value="{{ $res->prefix_value }}"
                                            {{ old('patient_prefix') === $res->prefix_value ? 'selected' : '' }}>
                                            {{ $res->prefix_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ชื่อ-สกุล</label>
                                <input type="text" id="patient_name" name="patient_name" class="form-control"
                                    value="{{ old('patient_name') }}" placeholder="ระบุชื่อ-สกุล">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เพศ</label>
                                <select id="patient_gender" name="patient_gender" class="custom-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($sex as $res)
                                        <option value="{{ $res->sex_id }}"
                                            {{ old('patient_gender') === $res->sex_id ? 'selected' : '' }}>
                                            {{ $res->sex_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">วันเกิด</label>
                                <input type="text" id="patient_dob" name="patient_dob" class="form-control"
                                    value="{{ old('patient_dob') }}" placeholder="ระบุวันเกิด">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">โทรศัพท์</label>
                                <input type="text" id="patient_tel" name="patient_tel" class="form-control"
                                    value="{{ old('patient_tel') }}" pattern="[0-9]" maxlength="10"
                                    placeholder="ระบุเฉพาะตัวเลข">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">บ้านเลขที่</label>
                                <input type="text" id="patient_hno" name="patient_hno" class="form-control"
                                    value="{{ old('patient_hno') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ถนน</label>
                                <input type="text" id="patient_hroad" name="patient_hroad" class="form-control"
                                    value="{{ old('patient_hroad') }}">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">หมู่ที่</label>
                                <input type="text" id="patient_hmoo" name="patient_hmoo" class="form-control"
                                    value="{{ old('patient_hmoo') }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">ชื่อหมู่บ้าน</label>
                                <input type="text" id="patient_hmooname" name="patient_hmooname" class="form-control"
                                    value="{{ old('patient_hmooname') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">ตำบล</label>
                                <select id="patient_htambon" name="patient_htambon" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($district as $res)
                                        <option value="{{ $res->dis_value }}"
                                            {{ old('patient_htambon') === $res->dis_value ? 'selected' : '' }}>
                                            {{ $res->dis_value." : ".$res->dis_name }}
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
                                            {{ old('patient_aumphur') === $res->aum_value."00" ? 'selected' : '' }}>
                                            {{ $res->aum_value." : ".$res->aum_name }}
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
                                            {{ old('patient_province') === $res->pro_code."0000" ? 'selected' : '' }}>
                                            {{ $res->pro_code."0000 : ".$res->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">หน่วยบริการที่รับผิดชอบ</label>
                                <select id="patient_hcode" name="patient_hcode" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($hcode as $res)
                                        <option value="{{ $res->hcode }}"
                                            {{ old('patient_hcode') === $res->hcode ? 'selected' : '' }}>
                                            {{ $res->hcode." : ".$res->hname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">คลินิกที่รับบริการ</label>
                                <select id="patient_clinic" name="patient_clinic" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($clinic as $res)
                                        <option value="{{ $res->id }}"
                                            {{ old('patient_clinic') === $res->id ? 'selected' : '' }}>
                                            {{ $res->clinic_sname." : ".$res->clinic_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    วันที่ลงทะเบียน
                                </label>
                                <input type="text" id="pc_date_start" name="pc_date_start" class="form-control basicDate"
                                    value="{{ old('pc_date_start') }}" placeholder="เลือกวันที่" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">
                                    <i class="fa-solid fa-prescription-bottle-medical"></i>
                                    ข้อมูลแพ้ยา
                                </label>
                                <div id="container"></div>
                                <div id="drugAllergy"></div>
                            </div>
                        </div>
                        <div class="text-right" style="margin-top: 1rem;">
                            <button type="button" class="btn btn-success" onclick="Swal.fire({
                                    title: 'ลงทะเบียนผู้ป่วยใหม่ ?',
                                    showCancelButton: true,
                                    confirmButtonText: `<i class='fa-solid fa-folder-plus'></i> ลงทะเบียน`,
                                    cancelButtonText: `<i class='fa-regular fa-times-circle'></i> ยกเลิก`,
                                    icon: 'success',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">
                                <i class="fa-solid fa-plus-circle"></i> ลงทะเบียน
                            </button>
                            <a href="{{ url('/patient') }}"
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
<script>
    $('#hn_find').click(function () {
        var regSelect = $('#basic-select2');
        var id = document.getElementById("hn").value;
        Swal.fire({
            title: 'กำลังค้นหาข้อมูล',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
            },
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {}
        })
        $.ajax({
            url: "http://172.20.55.222:5500/hn/" + id,
            success: function (result) {
                document.getElementById("hn_find").disabled = true;
                if ($.trim(result)) {
                    $("#patient_pid").val(result.patient_pid);
                    $("#patient_name").val(result.patient_firstname + " " + result.patient_lastname);
                    $('#patient_prefix').val(result.f_patient_prefix_id);
                    $('#patient_gender').val(result.f_sex_id);
                    $("#patient_dob").val(result.patient_birthday);
                    $("#patient_hno").val(result.patient_house);
                    $("#patient_hroad").val(result.patient_road);
                    $("#patient_hmoo").val(result.patient_moo);
                    $("#patient_htambon").val(result.patient_tambon).trigger('change');
                    $("#patient_aumphur").val(result.patient_amphur).trigger('change');
                    $("#patient_province").val(result.patient_changwat).trigger('change');
                    Swal.fire({
                        icon: 'success',
                        title: 'พบข้อมูล HN: ' + id,
                        text: result.patient_firstname + " " + result.patient_lastname,
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    $("#hn").val("");
                    $("#cid").val("");
                    $("#pname").val("");
                    $("#patient_dob").val("");
                    $("#patient_hno").val("");
                    $("#patient_hroad").val("");
                    $("#patient_hmoo").val("");
                    $("#patient_htambon").val("");
                    $("#patient_aumphur").val("");
                    $("#patient_province").val("");
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบ HN: ' + id,
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                var pid = result.t_patient_id;
                $.ajax({
                    url: "http://172.20.55.222:5500/drug_allergy/" + pid,
                    success: function (result) {
                        if ($.trim(result)) {
                            var container = document.querySelector('#container');
                            var ul = document.createElement('ul');
                            result.forEach(function (item) {
                                var li = document.createElement('li');
                                li.textContent = item.item_drug_standard_description;
                                ul.appendChild(li);
                            });
                                
                            container.appendChild(ul);
                                for (var i = 0; i < result.length; i++) {
                                var row =
                                    $('<input type="hidden" name="drug[]" value="'+ result[i].item_drug_standard_description +'">');
                                    $('#drugAllergy').append(row);
                                }
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สามารถเชื่อมต่อ DRUG API ได้',
                            text: 'Error: ' + textStatus + ' - ' + errorThrown,
                        })
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });
    });

</script>
@if($errors->any())
    <script>
        Swal.fire({
            title: 'พบข้อผิดพลาด',
            icon: 'warning',
            html: '<div class="text-left"><ul>@foreach ($errors->all() as $error)' +
                '<li>{{ $error }}</li>' +
                '@endforeach</ul></div>',
        })

    </script>
@endif
@endsection
