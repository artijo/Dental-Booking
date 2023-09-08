<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('admin.storepatient')}}" method="post">
    @csrf
        <label for="idcard">บัตรประจำตัวประชkชน</label> <br>
        <input type="number" name="idcard" ><br>
        <label for="name_th">ชื่อ (ภาษาไทย)</label><br>
        <input type="text" name="name_th" ><br>
        <label for="surname_th">นามสกุล (ภาษาไทย)</label><br>
        <input type="text" name="lastname_th" ><br>
        <label for="name_en">ชื่อ (ภาษาอังกฤษ)</label><br>
        <input type="text" name="name_en" ><br>
        <label for="surname_en">นามสกุล (ภาษาอังกฤษ)</label><br>
        <input type="text" name="lastname_en" ><br>
        <label for="tel">เบอร์โทรศัพท์</label><br>
        <input type="number" name="tel" ><br>
        <label for="email">อีเมล</label><br>
        <input type="email" name="email" ><br>
        <label for="gender">เพศ</label><br>
        <input type="radio" name="gender" value="male">
        <label for="male">ชาย</label>
        <input type="radio" name="gender" value="famale">
        <label for="famale">หญิง</label><br>
        <label for="birthday">วันเกิด</label><br>
        <input type="date" name="birthday" ><br>
        <label for="intolerance">โรคประจำตัว</label><br>
        <input type="text" name="intolerance" ><br>
        <input type="submit" value="บันทึกข้อมูล">

    </form>
</body>
</html>