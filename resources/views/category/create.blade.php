<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Danh mục</title>
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

        <h2>Thêm Danh mục mới</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh (URL)</label>
                <input type="file" name="image" class="form-control" value="{{ old('image') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục cha</label>
                <select name="parent_id" class="form-select">
                    <option value="">-- Không có --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>