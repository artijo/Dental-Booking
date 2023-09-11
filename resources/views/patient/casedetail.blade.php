<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>สวัสดีคุณ {{$user->name_th}}</h3>
    {{$case->case_title}} <br>
    {{$case->case_detail}} <br>
    {{$case->case_status}} <br>
    
    การนัดทั้งหมด <br>
    @foreach($case->bookings as $booking)
        {{$booking->booking_date}} <br>
    @endforeach
</body>
</html>