{{-- resources/views/tasks/show.blade.php --}}
@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Chi tiết Task #{{ $task->id }}</h3>
    <p><strong>Thuộc User ID:</strong> {{ $task->user_id }}</p>
    <p><strong>Tiêu đề:</strong> {{ $task->title }}</p>
    <p><strong>Hoàn thành:</strong>
      @if($task->completed)
        <span class="badge badge-success">Yes</span>
      @else
        <span class="badge badge-secondary">No</span>
      @endif
    </p>

    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary">Edit Task</a>
    <form action="{{ route('task.destroy', $task->id) }}" method="POST" class="d-inline">
      @csrf @method('DELETE')
      <input type="hidden" name="user_id" value="{{ $userId }}">
      <button class="btn btn-danger" onclick="return confirm('Xóa task?')">Delete Task</button>
    </form>

    <a href="{{ route('users.show', $userId) }}" class="btn btn-secondary mt-3">
      ← Quay về User
    </a>
  </div>
@endsection
