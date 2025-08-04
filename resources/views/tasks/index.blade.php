{{-- resources/views/tasks/index.blade.php --}}
@extends('layouts.lbd')

@section('content')
<div class="container-fluid">
  <h3 class="mt-4">Danh sách Task</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('task.create') }}" class="btn btn-success mb-3">
    Thêm Task
  </a>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Tiêu đề</th>
        <th>Hoàn thành</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
        <tr>
          <td>{{ $task->id }}</td>
          <td>{{ $task->user_id }}</td>
          <td>{{ $task->title }}</td>
          <td>
            @if($task->completed)
              <span class="badge badge-success">Yes</span>
            @else
              <span class="badge badge-secondary">No</span>
            @endif
          </td>
          <td class="d-flex gap-1">
            <a href="{{ route('task.edit', $task->id) }}"
               class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('task.destroy', $task->id) }}"
                  method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger"
                      onclick="return confirm('Xóa task này?')">
                Delete
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
