@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="h6 text-gray-800">
            Watchan Patient Care : โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
        </h5>
        <nav aria-label="breadcrumb" class="d-sm-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">ตั้งค่าระบบ</a></li>
              <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลหน่วยบริการ</li>
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
                                <i class="fa-solid fa-house-medical"></i> รายการข้อมูลหน่วยบริการ
                            </h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">
                                <i class="fa-solid fa-circle-plus"></i> เพิ่มรายการหน่วยบริการ
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableBasic" class="table table-borderless table-striped nowrap"
                    style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="1%">HOS : ID</th>
                                <th class="text-center">รหัสหน่วยบริการ</th>
                                <th class="">ชื่อหน่วยบริการ</th>
                                <th class="">ที่อยู่หน่วยบริการ</th>
                                <th class="text-center">Google Map</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hos as $res)
                            <tr>
                                <td class="text-center">{{ $res->id }}</td>
                                <td class="text-center">{{ $res->hcode }}</td>
                                <td class="">{{ $res->hname }}</td>
                                <td class="">{{ $res->haddress }}</td>
                                <td class="text-center">
                                    <a href="{{ $res->hmap }}" class="btn btn-danger btn-circle btn-sm" target="_blank">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <input id="btnToggle" type="checkbox"  data-id="{{ $res->id }}" 
                                    data-toggle="toggle" data-size="xs" data-onstyle="success" data-on="เปิด" data-off="ปิด" 
                                    {{ $res->hstatus == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-info btn-circle btn-sm">
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

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="addFrm" action="{{ route('hospital.add') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">
                        <i class="fa-solid fa-circle-plus"></i>
                        เพิ่มรายการหน่วยบริการ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">รหัสหน่วยบริการ</label>
                        <input type="text" name="hcode" class="form-control" placeholder="กรุณาระบุ">
                    </div>
                    <div class="form-group">
                        <label for="">ชื่อหน่วยบริการ</label>
                        <input type="text" name="hname" class="form-control" placeholder="กรุณาระบุ">
                    </div>
                    <div class="form-group">
                        <label for="">ที่อยู่หน่วยบริการ</label>
                        <input type="text" name="haddress" class="form-control" placeholder="กรุณาระบุ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                        ปิดหน้าต่าง
                    </button>
                    <button type="button" id="addBtn" class="btn btn-sm btn-success" onclick="Swal.fire({
                            title: 'เพิ่มรายการหน่วยบริการใหม่ ?',
                            showCancelButton: true,
                            confirmButtonText: `<i class='fa-solid fa-plus-circle'></i> เพิ่มรายการ`,
                            cancelButtonText: `<i class='fa-regular fa-times-circle'></i> ยกเลิก`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                                document.getElementById('addBtn').disabled = true;
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa-solid fa-plus-circle"></i>
                        เพิ่มรายการหน่วยบริการ
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {
        $("#tableBasic").on("change", "#btnToggle", function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var id = $(this).data('id'); 
            
            $.ajax({
                type: "GET",
                url: '/config/hospital/hstatus',
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log('update complete')
                }
            });
        })
    })
</script>
@endsection