    <div class="a-container">
        <nav class="dashboard-nav">
            <ul>
                <li><a href="{{route('patientlist.showpatient')}}">แสดงรายชื่อผู้รักษาทั้งหมด</a></li>
                <li><a href="{{route('doctor.showdoctor')}}">แสดงรายชื่อแพทย์ทั้งหมด</a></li>
                <li><a href="{{route('showcase.showbooking')}}">แสดงข้อมูลการนัดทั้งหมด</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
            </ul>
        </nav>
        <div class="content-dashboard">
            @yield('content-dashboard')
        </div>
    </div>