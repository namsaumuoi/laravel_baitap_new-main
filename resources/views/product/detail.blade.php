<!doctype html>
<html>
<head><meta charset="utf-8"><title>Chi tiết sản phẩm</title></head>
<body>
  <h1>Chi tiết: {{ $product['name'] }}</h1>
  <p>ID: {{ $product['id'] }}</p>
  <p>Giá: {{ $product['price'] }}</p>
  <p><a href="{{ route('product.index') }}">Quay lại</a></p>
</body>
</html>