<!doctype html>
<html>
<head><meta charset="utf-8"><title>SignIn</title></head>
<body>
  <h1>Sign In (Đăng ký demo)</h1>
  <form method="POST" action="{{ route('auth.checksign') }}">
    @csrf
    <label>Username: <input name="username" required></label><br>
    <label>Password: <input name="password" type="password" required></label><br>
    <label>Re-pass: <input name="repass" type="password" required></label><br>
    <label>MSSV: <input name="mssv" required></label><br>
    <label>Lớp môn học: <input name="lopmonhoc" required></label><br>
    <label>Giới tính: <input name="gioitinh" required></label><br>
    <button type="submit">Sign In</button>
  </form>
  <p>Ví dụ: DuocND, 123456, 123456, 0305467, 67PM2, nam</p>
</body>
</html>