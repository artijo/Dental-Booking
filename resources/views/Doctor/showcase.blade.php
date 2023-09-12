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
            <td>ลำดับ</td>
            <td>รายการ</td>
            <td>สถานะ</td>
        </tr>
    
    @foreach($cases as $item)
            <tr>
                <td>{{$cases->firstItem()+$loop->index}}</td>
                <td>{{$item->case_title}}</td>
                <td>{{$item->tel}}</td>
                <td>{{$item->case_status}}</td>
                <td><a href="{{url('/admin/doctor/case/'.$item->caseid)}}">รายละเอียดเพิ่มเติม</a></td>
            </tr>
    @endforeach
    </table>
</body>
</html>