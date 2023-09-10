<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('/admin/support/update/'.$support->support_id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">ชื่อ</label><br>
        <input type="text" name="name" placeholder="ชื่อ" value="{{$support->name}}"><br>
        <label for="level">สิทธ์การเข้าถึง</label>
        <select name="level" id="level">
            <option value="0">ผู้ดูแลระบบ</option>
            <option value="1">เจ้าหน้าที่</option>
        </select><br>
        <label for="tel">เบอร์โทรศัพท์</label><br>
        <input type="text" name="tel" placeholder="เบอร์โทรศัพท์" value="{{$support->tel}}"><br>
        <label for="email">อีเมล</label><br>
        <input type="email" name="email" placeholder="อีเมล" value="{{$support->email}}"><br>
        <label for="password">รหัสผ่าน</label><br>
        <input type="password" name="password" placeholder="รหัสผ่าน"><br>
        <label for="password_confirmation">ยืนยันรหัสผ่าน</label><br>
        <input type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน"><br>
        <input type="submit" value="แก้ไขข้อมูล">
    </form>
</body>
</html>