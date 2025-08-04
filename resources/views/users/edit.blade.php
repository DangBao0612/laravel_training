@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Sửa User #{{ $user->id }}</h3>

    <form action="{{ route('users.update', $user) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="name">Tên</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control"
               value="{{ old('name', $user->name) }}"
               required>
      </div>

      <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email"
               id="email"
               name="email"
               class="form-control"
               value="{{ old('email', $user->email) }}"
               required>
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="{{ route('users.show', $user) }}" class="btn btn-secondary ms-2">← Quay về</a>
    </form>
  </div>
@endsection
