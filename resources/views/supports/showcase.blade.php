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
            <th>รายการ</th>
            <th>สถานะ</th>
        </tr>
    
    @foreach ($cases as $item)
        <tr>
            <td>{{$cases->firstItem()+$loop->index}}</td>
            <td>{{$item->case_title}}</td>
            <td>{{$item->case_status}}</td>
            <td><a href="{{url('/admin/case/'.$item->caseid)}}">รายละเอียดเเพิ่มเติม</a></td>
        </tr>
        
    @endforeach
    {{$cases->links()}}
</table>
</body>
</html>