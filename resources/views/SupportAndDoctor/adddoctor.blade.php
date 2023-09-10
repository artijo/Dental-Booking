<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('doctor.storedoctor')}}" method="POST">
    @csrf
        <label for="name_en">ขื่อ(ภาษาอังกฤษ)</label>
        <input type="text" name="name_en"> <br>
        <label for="lastname_en">นามสกุล(ภาษาอังกฤษ)</label>
        <input type="text" name="lastname_en"> <br>
        <label for="name_th">ชื่อ(ภาษาไทย ไม่ต้องมีคำนำหน้าชื่อ)</label>
        <input type="text" name="name_th"> <br>
        <label for="lastname_th">นามสกุล(ภาษาไทย)</label>
        <input type="text" name="lastname_th"> <br>
        <label for="email">อีเมล</label>
        <input type="text" name="email"> <br>
        <label for="password">รหัสผ่าน</label>
        <input type="password" name="password"> <br>
        <label for="tel">เบอร์โทรศัพท์</label>
        <input type="text" name="tel" > <br>
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