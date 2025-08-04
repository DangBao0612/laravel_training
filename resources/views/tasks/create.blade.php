{{-- resources/views/tasks/create.blade.php --}}
@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Thêm Task cho User: {{ $user->email ?? $user->name }}</h3>

    <form action="{{ route('task.store') }}" method="POST">
      @csrf

      {{-- Giữ user_id để redirect về đúng user sau khi lưu --}}
      <input type="hidden" name="user_id" value="{{ $userId }}">

      {{-- Tiêu đề --}}
      <div class="form-group mb-3">
        <label for="title">Tiêu đề</label>
        <input
          type="text"
          id="title"
          name="title"
          class="form-control"
          value="{{ old('title') }}"
          required
        >
      </div>

      {{-- Hoàn thành --}}
      <div class="form-check mb-3">
        <input
          type="checkbox"
          id="completed"
          name="completed"
          class="form-check-input"
          value="1"
          {{ old('completed') ? 'checked' : '' }}
        >
        <label for="completed" class="form-check-label">Hoàn thành</label>
      </div>

      <button type="submit" class="btn btn-primary">Lưu Task</button>
      <a href="{{ route('users.show', $userId) }}" class="btn btn-secondary ms-2">
        ← Quay về User
      </a>
    </form>
  </div>
@endsection
