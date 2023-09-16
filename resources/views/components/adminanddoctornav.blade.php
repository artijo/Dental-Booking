<nav class="dashboard-nav">
    @if(session('supportid'))
    <ul>
        <li><a href="{{route('admin.index')}}" @if(Request::is('admin')) class="current" @endif>หน้าหลัก</a></li>
        <li><a href="{{route('patientlist.showpatient')}}">รายชื่อผู้รักษา</a></li>
        <li><a href="{{route('doctor.showdoctor')}}">รายชื่อแพทย์</a></li>
        <li><a href="{{route('showcase.showcase')}}">ข้อมูลเคสการรักษา</a></li>
        <li><a href="{{route('showcase.showbooking')}}">ข้อมูลการนัด</a></li>
        @if(session('level') === 0)
        <li><a href="{{route('admin.showsupport')}}">รายชื่อผู้ดูแลระบบ</a></li>
        @endif
    </ul>
    @elseif(session('doctor_id'))
    <ul>
        <li><a href="{{route('Doctor')}}">หน้าหลัก</a></li>
        <li><a href="{{route('Doctor.shpwpatient')}}">รายชื่อผู้รักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showcase')}}">ประวัติเคสการรักษาของคุณ</a></li>
        <li><a href="{{route('doctor.showbooking')}}">บันทึกการนัดของคุณ</a></li>
    </ul>
    @endif
</nav>