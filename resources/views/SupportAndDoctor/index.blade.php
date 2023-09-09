<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hello
    {{$name}}
    <a href="{{ route('admin.logout') }}">ออกจากระบบ</a>
    <a href="{{ route('admin.addsupport') }}"><button>Add Support</button></a>
    <a href="{{ route('patient.addpatient') }}"><button>Add Patient</button></a>
    <a href="{{ route('patient.addcase') }}"><button>Add Case</button></a>
    <a href="{{route('doctor.adddoctor')}}"><button>Add Doctor</button></a>
    <a href="{{route('booking.addbooking')}}"><button>Add Booking</button></a>
</body>
</html>