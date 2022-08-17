<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img class="img img-fluid" src="{{ asset('img/wc_logo_1.png') }}">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
     <!-- Heading -->
     <div class="sidebar-heading">
        เมนูระบบ
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->is('patient*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('patient*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#cl-patient"
            aria-expanded="true" aria-controls="cl-patient">
            <i class="fa-solid fa-fw fa-address-book"></i>
            <span>ข้อมูลผู้ป่วย</span>
        </a>
        <div id="cl-patient" class="collapse {{ (request()->is('patient*')) ? 'show' : '' }}" aria-labelledby="headingPatient" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item text-xs {{ (request()->is('patient')) || (request()->is('patient/register')) ? 'active' : '' }}" 
                    href="{{ url('patient') }}">
                    ข้อมูลผู้ป่วยทั้งหมด
                </a>
                <a class="collapse-item text-xs {{ (request()->is('patient/hcode')) ? 'active' : '' }}" href="#">
                    ข้อมูลผู้ป่วยที่รับผิดชอบ
                </a>
                <a class="collapse-item text-xs {{ (request()->is('patient/clinic')) ? 'active' : '' }}" href="#">
                    ข้อมูลผู้ป่วยแยกตามคลินิก
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('config*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('config*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#cl-config"
            aria-expanded="true" aria-controls="cl-config">
            <i class="fa-solid fa-fw fa-gear"></i>
            <span>ตั้งค่าระบบ</span>
        </a>
        <div id="cl-config" class="collapse {{ (request()->is('config*')) ? 'show' : '' }}" aria-labelledby="headingConfig" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item text-xs {{ (request()->is('config/users')) ? 'active' : '' }}" 
                    href="{{ url('config/user') }}">
                    จัดการผู้ใช้งาน
                </a>
                <a class="collapse-item text-xs {{ (request()->is('config/clinic')) ? 'active' : '' }}" 
                    href="{{ url('config/clinic') }}">
                    จัดการข้อมูลคลินิก
                </a>
                <a class="collapse-item text-xs {{ (request()->is('config/hospital')) ? 'active' : '' }}" 
                    href="{{ url('config/hospital') }}">
                    จัดการหน่วยบริการ
                </a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->