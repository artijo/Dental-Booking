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
        <label for="doctor id">รหัสแพทย์</label>
        <input type="text" name="doctor_id"> <br>
        <label for="name_en">ขื่อ(ภาษาอังกฤษ)</label>
        <input type="text" name="name_en"> <br>
        <label for="lastname_en">นามสกุล(ภาษาอังกฤษ)</label>
        <input type="text" name="lastname_en"> <br>
        <label for="name_th">ชื่อ(ภาษาไทย)</label>
        <input type="text" name="name_th"> <br>
        <label for="lastname_th">นามสกุล(ภาษาไทย)</label>
        <input type="text" name="lastname_th"> <br>
        <label for="email">อีเมล</label>
        <input type="text" name="email"> <br>
        <label for="password">รหัส</label>
        <input type="password" name="password"> <br>
        <label for="tel">เบอร์โทรศัพท์</label>
        <input type="text" name="tel" > <br>
        <label for="specialist_id">ความเชี่ยวชาญ</label>
        <select name="spacialist_id" id="specialist">
            @foreach($spacialist as $list)
            <option value="{{ $list->spacialist_id }}">{{ $list->name_th }}</option>
            @endforeach
        </select> <br>
        <input type="submit" value="บันทึกข้อมูล">
    </form>
</body>
</html>