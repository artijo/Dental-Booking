<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
    <form action="{{route('admin.storebooking')}}" method="POST">
        @csrf

        <label for="caseid">รหัสเคส</label>
        <select class="selectcase" name="caseid">
            @foreach($cases as $list)
            <option value="{{$list->caseid}}">{{ $list->caseid }}</option>
            @endforeach
          </select><br>

        <label for="booking_title">หัวข้อการนัด</label>
        <input type="text" name="booking_title"><br>

        <label for="booking_detail">รายละเอียดการนัด</label>
        <input type="text" name="booking_detail"><br>

        <label for="booking_date">วันและเวลาที่นัด</label>
        <input type="datetime-local" name="booking_date"><br>

        <input type="submit" name="booking_submit" value="บันทึก">
    </form>
    <script src="{{asset('js/select2.js')}}"></script>
</body>
</html>