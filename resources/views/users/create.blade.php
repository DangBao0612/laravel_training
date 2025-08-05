@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Thêm User mới</h3>

    {{-- 1. Hiển thị chung nếu có error validation --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
      @csrf

      {{-- Tên --}}
      <div class="form-group mb-3">
        <label for="name">Tên</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}"
               required>
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Email --}}
      <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email"
               id="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}"
               required>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Mật khẩu --}}
      <div class="form-group mb-3">
        <label for="password">Mật khẩu</label>
        <input type="password"
               id="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Xác nhận mật khẩu --}}
      <div class="form-group mb-3">
        <label for="password_confirmation">Xác nhận mật khẩu</label>
        <input type="password"
               id="password_confirmation"
               name="password_confirmation"
               class="form-control">
      </div>

      <button type="submit" class="btn btn-success">Lưu User</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">← Quay về</a>
    </form>
  </div>
@endsection
