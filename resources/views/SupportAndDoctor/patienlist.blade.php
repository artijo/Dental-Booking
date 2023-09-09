<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,th,td{
            border:1px solid;
            border-collapse: collapse;
        }
        svg{
            width:20px;
        }
    </style>
</head>
<body>

    Hello
   
    <a href="{{ route('admin.logout') }}">ออกจากระบบ</a>
    <a href="{{ route('admin.addsupport') }}"><button>Add Support</button></a>
    <a href="{{ route('patient.addpatient') }}"><button>Add Patient</button></a>
    <a href="{{ route('patient.addcase') }}"><button>Add Case</button></a>
    <a href="{{route('doctor.adddoctor')}}"><button>Add Doctor</button></a>
    <a href="{{route('booking.addbooking')}}"><button>Add Booking</button></a>

    <table>
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>เบอร์โทรศัพท์</th>
    </tr>
          @foreach ( $page as $pt) 
                <tr>
                <td>{{$page->firstItem()+$loop->index}}</td>
                <td>{{$pt->name_th}}</td>
                <td>{{$pt->lastname_th}}</td>
                <td><a href='#'>รายละเอียดเพิ่มเติม</a></td>
                </tr>
        @endforeach
    </table>
 {{$page}}
</body>
</html>