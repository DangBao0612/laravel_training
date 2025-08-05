{{-- resources/views/tasks/edit.blade.php --}}
@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Sửa Task #{{ $task->id }}</h3>

    <form action="{{ route('task.update', $task->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Giữ user_id để redirect về đúng user sau khi lưu --}}
      <input type="hidden" name="user_id" value="{{ $task->user_id }}">

      {{-- Tiêu đề --}}
      <div class="form-group mb-3">
        <label for="title">Tiêu đề</label>
        <input
          type="text"
          id="title"
          name="title"
          class="form-control"
          value="{{ old('title', $task->title) }}"
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
          {{ $task->completed ? 'checked' : '' }}
        >
        <label for="completed" class="form-check-label">Hoàn thành</label>
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="{{ route('users.show', $task->user_id) }}" class="btn btn-secondary ms-2">
        ← Quay về User
      </a>
    </form>
  </div>
@endsection
