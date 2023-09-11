<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="{{ route('doctor.logout') }}">ออกจากระบบ</a>
    <h1>สวัสดี นายแพทย์{{$doctor->name_th}} {{$doctor->lastname_th}}</h1>
    <h2>นี่คือข้อมูลผู้ป่วยของท่าน</h2>
    <table border=1>
        <thead>
            <tr>
                <td>ลำดับ</td>
                <td>ชื่อ</td>
                <td>หมายเลขโทรศัพท์</td>
                <td>จำนวนการรักษา(ครั้ง)</td>
            </tr>
        </thead>
            @foreach($patient as $item)
            <tr>
                <td>{{$patient->firstItem()+$loop->index}}</td>
                <td>{{$item->patient->name_th}} {{$item->patient->lastname_th}}</td>
                <td>{{$item->patient->tel}}</td>
                <td></td>
                <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
            @endforeach
    </table>
    <!-- <a href="{{ route('admin.addsupport') }}"><button>Add Support</button></a>
    <a href="{{ route('patient.addpatient') }}"><button>Add Patient</button></a>
    <a href="{{ route('patient.addcase') }}"><button>Add Case</button></a>
    <a href="{{route('doctor.adddoctor')}}"><button>Add Doctor</button></a>
    <a href="{{route('booking.addbooking')}}"><button>Add Booking</button></a>
    <a href="{{route('showcase.showhistory')}}"><button>Booking History</button></a> --> -->
</body>
</html>