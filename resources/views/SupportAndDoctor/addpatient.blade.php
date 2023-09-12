<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @error('idcard')
    {{ $message }}
    @enderror
    <form action="{{route('admin.storepatient')}}" method="post">
    @csrf
        <label for="idcard">บัตรประจำตัวประชาชน</label> <br>
        <input type="number" name="idcard" pattern="[0-9]{13}" required><br>
        <label for="name_th">ชื่อ (ภาษาไทย)</label><br>
        <input type="text" name="name_th" max="255" pattern="[\u0E00-\u0E7F]+" required><br>
        <label for="surname_th">นามสกุล (ภาษาไทย)</label><br>
        <input type="text" name="lastname_th" max="255" pattern="[\u0E00-\u0E7F]+" required><br>
        <label for="name_en">ชื่อ (ภาษาอังกฤษ)</label><br>
        <input type="text" name="name_en" max="255" pattern="[a-zA-Z]+"><br>
        <label for="surname_en">นามสกุล (ภาษาอังกฤษ)</label><br>
        <input type="text" name="lastname_en" max="255" pattern="[a-zA-Z]+"><br>
        <label for="tel">เบอร์โทรศัพท์</label><br>
        <input type="tel" name="tel" pattern="[0-9]{10}" required><br>
        <label for="email">อีเมล</label><br>
        <input type="email" name="email" max="255" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$"><br>
        <label for="gender">เพศ</label><br>
        <input type="radio" name="gender" value="male" required>
        <label for="male">ชาย</label>
        <input type="radio" name="gender" value="female" required>
        <label for="famale">หญิง</label><br>
        <label for="birthday">วันเกิด</label><br>
        <input type="date" name="birthday" required><br>
        <label for="intolerance">โรคประจำตัว</label><br>
        <input type="text" name="intolerance" ><br>
        <input type="submit" value="บันทึกข้อมูล">

    </form>
</body>
</html>