<!doctype html>
<html>
<head><meta charset="utf-8"><title>Home</title></head>
<body>
  <h1>Trang Home</h1>
  <ul>
    <li><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>
    <li><a href="{{ route('product.add') }}">Thêm sản phẩm</a></li>
    <li><a href="{{ route('student.show') }}">Thông tin sinh viên (mặc định)</a></li>
    <li><a href="{{ route('banco', ['n' => 8]) }}">Xem bàn cờ 8x8</a></li>
  </ul>
</body>
</html>