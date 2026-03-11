<!doctype html>
<html>
<head><meta charset="utf-8"><title>Thêm sản phẩm</title></head>
<body>
  <h1>Thêm sản phẩm mới</h1>
  <form method="POST" action="{{ route('product.store') }}">
    @csrf
    <label>ID: <input name="id" required></label><br>
    <label>Name: <input name="name" required></label><br>
    <label>Price: <input name="price" required type="number"></label><br>
    <button type="submit">Thêm</button>
  </form>
</body>
</html>