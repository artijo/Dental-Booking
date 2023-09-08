<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('admin.storebooking')}}" method="POST">
        @csrf
        <label for="booking_id">รหัสการนัด</label>
        <input type="text" name="booking_id"><br>

        <label for="caseid">รหัสเคส</label>
        <input type="text" name="caseid"><br>

        <label for="booking_title">หัวข้อการนัด</label>
        <input type="text" name="booking_title"><br>

        <label for="booking_detail">รายละเอียดการนัด</label>
        <input type="text" name="booking_detail"><br>

        <label for="booking_date">วันและเวลาที่นัด</label>
        <input type="datetime-local" name="booking_date"><br>

        <input type="submit" name="booking_submit" value="บันทึก">
    </form>
</body>
</html>