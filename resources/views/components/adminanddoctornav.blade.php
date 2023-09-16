<nav class="dashboard-nav">
    @if(session('supportid'))
    <ul>
        <li><a href="{{route('admin.index')}}" @if(Request::is('admin')) class="current" @endif>หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}" @if(Request::is('admin/patient*')) class="current" @endif>รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}" @if(Request::is('admin/showdoctor*')) class="current" @endif>รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}" @if(Request::is('admin/*case*')) class="current" @endif>ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}"@if(Request::is('admin/*booking*')) class="current" @endif>ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="{{route('admin.showsupport')}}" @if(Request::is('admin/*support*')) class="current" @endif>รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
    @elseif(session('doctor_id'))
    <ul>
        <li><a href="{{route('Doctor')}}"@if(Request::is('admin/doctor')) class="current" @endif>หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}"@if(Request::is('admin/*patient*')) class="current" @endif>รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}"@if(Request::is('admin/*case*')) class="current" @endif>ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}"@if(Request::is('admin/*booking*')) class="current" @endif>บันทึกการนัดของคุณ</a></li>
    </ul>
    @endif
</nav>