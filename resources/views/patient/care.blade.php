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
        <div class="card-body">
            <div class="tab-vertical">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    @php $i=0; @endphp
                    @foreach ($visit as $vs)
                    @php $i++; @endphp
                    <li class="nav-item">
                            <a class="nav-link tabClick" id="box-vertical" data-toggle="tab" href="#box-vertical{{ @$vs->visit_id }}"
                            role="tab" aria-controls="home" aria-selected="true"
                            data-id="{{ @$vs->visit_id }}">
                            <i class="fa-regular fa-calendar-check"></i>
                            {{ DateThai($vs->visit_date) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent3">
                    <div class="tab-pane show active" id="box-vertical{{ @$vs->visit_id }}" role="tabpanel"
                        aria-labelledby="box-vertical">
                        <p id="div_head" class="lead"></p>
                        <p id="visit_ccpi"></p>
                        <p id="visit_phex"></p>
                        <p id="visit_diag"></p>
                        <div id="container"></div>
                        <table id="vital" class="table table-bordered table-sm"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNew" aria-labelledby="addNewLabel" aria-hidden="true">
    <form action="{{ route('patient.visit',$patient->pc_id) }}">
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
                                <option value="1">ผู้พิการ</option>
                                <option value="2">ผู้สูงอายุ</option>
                                <option value="0">ไม่ระบุ</option>
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
                                            <input type="text" name="temp" class="form-control text-center"
                                            value="{{ old('temp') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="bp" class="form-control text-center"
                                            value="{{ old('bp') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="rr" class="form-control text-center"
                                            value="{{ old('rr') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="hr" class="form-control text-center"
                                            value="{{ old('hr') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="weight" class="form-control text-center"
                                            value="{{ old('weight') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="height" class="form-control text-center"
                                            value="{{ old('height') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="bmi" class="form-control text-center"
                                            value="{{ old('bmi') }}">
                                        </td>
                                        <td>
                                            <input type="text" name="osat" class="form-control text-center"
                                            value="{{ old('osat') }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                ประวัติการเจ็บป่วย
                            </label>
                            <textarea type="text" name="ccpi" rows="3" class="form-control" value="{{ old('ccpi') }}"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                ประวัติการตรวจร่างกาย
                            </label>
                            <textarea type="text" name="psexam" rows="3" class="form-control" value="{{ old('psexam') }}"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                การวินิจฉัย 
                                <small class="text-danger">
                                    ค้นหาจากรหัสโรค/อาการ
                                </small>
                            </label>
                            <select id="visit_icd10" name="visit_icd10" class="basic-select2" style="width: 100%;">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">
                                รายการตรวจรักษา
                                <small class="text-danger">
                                    เลือกได้มากกว่า 1 รายการ
                                </small>
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
                    <button type="button" class="btn btn-success btn-sm"
                        onclick="Swal.fire({
                            title: 'บันทึกการติดตาม ?',
                            text: 'หากบันทึกแล้วจะไม่สามารถแก้ไขได้',
                            showCancelButton: true,
                            confirmButtonText: `<i class='fa-solid fa-folder-plus'></i> บันทึกข้อมูล`,
                            cancelButtonText: `<i class='fa-regular fa-times-circle'></i> ยกเลิก`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
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
<script>
    $(document).ready(function(){        
        $( "#visit_icd10" ).select2({
            ajax: { 
            url: "{{ route('diag.all') }}",
            type: "post",
            dataType: 'json',
            delay: 250,
                data: function (params) {
                return {
                    _token: "{{ csrf_token() }}",
                    search: params.term
                };
            },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
            }
        });
    });

    $('.tabClick').click(function () {
        $('#container').html("");
        var id = $(this).data('id');
        $.ajax({
            url: "/api/get_visit/" + id,
            success: function (data) {
                if ($.trim(data)) {
                    $('#div_head').html("");
                    var div_head = document.querySelector('#div_head');
                    var created = document.createElement('b');
                        created.textContent = "ผู้บันทึกการติดตาม : "+ data.result.user_name +" "+ data.result.user_position;
                        div_head.appendChild(created); 

                    $('#visit_ccpi').text("ประวัติการเจ็บป่วย : " + data.result.visit_ccpi);
                    $('#visit_phex').text("ประวัติการตรวจร่างกาย : " + data.result.visit_physical_ex);
                    $('#visit_diag').text("การวินิจฉัย : " + data.result.icd10_number + " " + data.result.icd10_description);

                    var container = document.querySelector('#container');
                    var text = document.createElement('b');
                            text.textContent = "รายการตรวจรักษา";
                            container.appendChild(text); 
                    var ul = document.createElement('ul');
                    Array.from(data.order).forEach(element => {
                        var li = document.createElement('li');
                            li.textContent = element.item_common_name;
                            ul.appendChild(li);     
                    });
                    container.appendChild(ul);
                    
                    $('thead').html("");
                    $('tbody').html("");
                    var row =
                        $(
                            '<thead class="thead-light text-center">' +
                                '<tr>' +
                                    '<th colspan="8">บันทึกสัญญาณชีพ : Vital Sign</th>' +
                                '</tr>' +
                                '<tr>' +
                                    '<th>Temp</th>' +
                                    '<th>BP</th>' +
                                    '<th>RR</th>' +
                                    '<th>HR</th>' +
                                    '<th>น้ำหนัก</th>' +
                                    '<th>ส่วนสูง</th>' +
                                    '<th>BMI</th>' +
                                    '<th>O2sat</th>' +
                                '</tr>' +
                            '</thead>' +
                            '<tbody class="text-center"><tr>' + 
                            '<td>' + data.vital[0] + '</td>' +
                            '<td>' + data.vital[1] + '</td>' +
                            '<td>' + data.vital[2] + '</td>' +
                            '<td>' + data.vital[3] + '</td>' +
                            '<td>' + data.vital[4] + '</td>' +
                            '<td>' + data.vital[5] + '</td>' +
                            '<td>' + data.vital[6] + '</td>' +
                            '<td>' + data.vital[7] + '</td>' +
                            '</tr></tbody>'
                            );
                    $('#vital').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            },
        });
    });
</script>
@endsection
