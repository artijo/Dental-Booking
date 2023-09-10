<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('/admin/doctor/update/'.$doctor->doctor_id) }}" method="POST">
    @csrf
    @method('PUT')
        <label for="name_en">ขื่อ(ภาษาอังกฤษ)</label>
        <input type="text" name="name_en" value="{{$doctor->name_en}}"> <br>
        <label for="lastname_en">นามสกุล(ภาษาอังกฤษ)</label>
        <input type="text" name="lastname_en" value="{{$doctor->name_en}}"> <br>
        <label for="name_th">ชื่อ(ภาษาไทย ไม่ต้องมีคำนำหน้าชื่อ)</label>
        <input type="text" name="name_th" value="{{$doctor->name_th}}"> <br>
        <label for="lastname_th">นามสกุล(ภาษาไทย)</label>
        <input type="text" name="lastname_th" value="{{$doctor->lastname_th}}"> <br>
        <label for="email">อีเมล</label>
        <input type="text" name="email" value="{{$doctor->email}}"> <br>
        <label for="password">รหัส</label>
        <input type="password" name="password" > <br>
        <label for="tel">เบอร์โทรศัพท์</label>
        <input type="text" name="tel" value="{{$doctor->tel}}"> <br>
        <label for="specialist_id">ความเชี่ยวชาญ</label>
        @if(!empty($spacialist) && count($spacialist) > 0)
            <select name="specialist_id" id="specialist">
                @foreach($spacialist as $list)
                <option value="{{ $list->specialist_id }}">{{ $list->name_th }}</option>
                @endforeach
            </select> <br>
        @else
        ไม่มีข้อมูลเฉพาะทางในขณะนี้<br>
        @endif
        <input type="submit" value="บันทึกข้อมูล">
    </form>
</body>
</html>