<!doctype html>
<html><body>
  <h1>Nhập tuổi</h1>
  <form method="POST" action="{{ route('age.store') }}">
    @csrf
    <label>Tuổi: <input name="age" required></label>
    <button type="submit">Gửi</button>
  </form>
</body></html>