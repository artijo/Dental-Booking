<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('admin/patient/update/'.$patient->idcard)}}" method="post">
        @csrf
        @method('PUT')
            <label for="idcard">บัตรประจำตัวประชkชน</label> <br>
            <input type="number" name="idcard" value="{{$patient->idcard}}" disabled><br>
            <label for="name_th">ชื่อ (ภาษาไทย)</label><br>
            <input type="text" name="name_th" value="{{$patient->name_th}}"><br>
            <label for="surname_th">นามสกุล (ภาษาไทย)</label><br>
            <input type="text" name="lastname_th" value="{{$patient->lastname_th}}"><br>
            <label for="name_en">ชื่อ (ภาษาอังกฤษ)</label><br>
            <input type="text" name="name_en" value="{{$patient->name_en}}"><br>
            <label for="surname_en">นามสกุล (ภาษาอังกฤษ)</label><br>
            <input type="text" name="lastname_en" value="{{$patient->lastname_en}}"><br>
            <label for="tel">เบอร์โทรศัพท์</label><br>
            <input type="number" name="tel" value="{{$patient->tel}}"><br>
            <label for="email">อีเมล</label><br>
            <input type="email" name="email" value="{{$patient->email}}"><br>
            @if($patient->gender === 'male')
            <label for="gender">เพศ</label><br>
            <input type="radio" name="gender" value="male" checked>
            <label for="male">ชาย</label>
            <input type="radio" name="gender" value="female">
            <label for="famale">หญิง</label><br>
            @elseif($patient->gender === 'female')
            <input type="radio" name="gender" value="male">
            <label for="male">ชาย</label>
            <input type="radio" name="gender" value="female" checked>
            <label for="famale">หญิง</label><br>
            @endif
            <label for="birthday">วันเกิด</label><br>
            <input type="date" name="birthday" value="{{$patient->birthday}}"><br>
            <label for="intolerance">โรคประจำตัว</label><br>
            <input type="text" name="intolerance" value="{{$patient->intolerance}}"><br>
            <input type="submit" value="บันทึกข้อมูล">
        </form>
</body>
</html>