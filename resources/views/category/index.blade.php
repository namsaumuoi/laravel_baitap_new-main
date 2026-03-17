<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Danh mục</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">

        {{-- Menu --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Trang chủ</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Quản lý Danh mục
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}">Xem danh sách</a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.create') }}">Thêm mới</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h2>Danh sách Danh mục</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Danh mục cha</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" width="60" class="rounded">
                        @else
                        <span class="text-muted">Không có</span>
                        @endif
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->parent->name ?? 'Không có' }}</td>
                    <td>
                        @if($category->is_active)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Chưa có danh mục nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>