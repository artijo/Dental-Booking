<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($viewpatient as $item)
    รหัสผู้ป่วย : {{$item->patient->idcard}}
    @endforeach
</body>
</html>