<!doctype html>
<html>
<head><meta charset="utf-8"><title>Products</title></head>
<body>
  <h1>Danh sách sản phẩm</h1>
  @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif
  <a href="{{ route('product.add') }}">Thêm mới sản phẩm</a>
  <ul>
    @foreach($products as $p)
      <li>
        <strong>{{ $p['name'] }}</strong> - {{ $p['price'] }} -
        <a href="{{ route('product.show', ['id' => $p['id']]) }}">Chi tiết</a>
      </li>
    @endforeach
  </ul>
</body>
</html>