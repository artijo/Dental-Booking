<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('/admin/booking/update/'.$booking->booking_id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="caseid">รหัสเคส</label>
        <input type="text" name="caseid" value="{{$booking->caseid}}" disabled><br>

        <label for="booking_title">หัวข้อการนัด</label>
        <input type="text" name="booking_title" value="{{$booking->booking_title}}"><br>

        <label for="booking_detail">รายละเอียดการนัด</label>
        <input type="text" name="booking_detail" value="{{$booking->booking_detail}}"><br>

        <label for="booking_date">วันและเวลาที่นัด</label>
        <input type="datetime-local" name="booking_date" value="{{$booking->booking_date}}"><br>

        <input type="submit" name="booking_submit" value="บันทึก">
    </form>
</body>
</html>