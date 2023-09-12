<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>รายการนัด</th>
            <th>รายละเอียดการนัด</th>
            <th>วันที่นัด</th>
        </tr>
        @foreach($booking as $bk)
            @foreach($bk->bookings as $item)
            <tr>
                <td>{{$booking->firstItem()+$loop->index}}</td>
                <td>{{$item->booking_title}}</td>
                <td>{{$item->booking_detail}}</td>
                <td>{{$item->booking_date}}</td>
                <td><a href="{{url('/admin/doctor/case/'.$item->case->caseid)}}">เพิ่มเติมเกี่ยวกับการนัด</a></td>
            </tr>
            @endforeach
        @endforeach
    </table>
</body>
</html>