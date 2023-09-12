<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Doctor</title>
</head>
<body>
    <a href="{{ route('admin.logout') }}">ออกจากระบบ</a>
    <a href="{{ route('admin.addsupport') }}"><button>Add Support</button></a>
    <a href="{{ route('patient.addpatient') }}"><button>Add Patient</button></a>
    <a href="{{ route('patient.addcase') }}"><button>Add Case</button></a>
    <a href="{{route('doctor.adddoctor')}}"><button>Add Doctor</button></a>
    <a href="{{route('booking.addbooking')}}"><button>Add Booking</button></a>
    <a href="{{route('patientlist.showpatient')}}"><button>Patient List</button></a>
    <a href="{{route('doctor.showdoctor')}}"><button disabled>Doctor List</button></a>
    <a href="{{route('showcase.showhistory')}}"><button>Booking History</button></a>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>เบอร์โทรศัพท์</th>
            <th>จำนวนการรักษา(ครั้ง)</th>
            <th>รายละเอียดเพิ่มเติม</th>
        </tr>
        @foreach($count as $case)
        <tr>
            <td>{{$count->firstItem()+$loop->index}}</td><td>{{$case->fullname}}</td><td>{{$case->tel}}</td><td>{{$case->casetotal}}</td>
            <td><a href="{{url('/admin/showdoctor/'.$case->doctorid)}}">รายละเอียดเพิ่มเติม</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>