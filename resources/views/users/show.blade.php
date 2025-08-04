{{-- resources/views/users/show.blade.php --}}
@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3>Chi tiết User: {{ $user->name }}</h3>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('task.create', ['user_id' => $user->id]) }}"
       class="btn btn-success mb-3">
      Thêm Task mới
    </a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tiêu đề</th>
          <th>Hoàn thành</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tasks as $task)
          <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>
              @if($task->completed)
                <span class="badge badge-success">Yes</span>
              @else
                <span class="badge badge-secondary">No</span>
              @endif
            </td>
            <td class="d-flex gap-1">
              {{-- Nút Edit --}}
              <a href="{{ route('task.edit', $task->id) }}?user_id={{ $user->id }}"
                 class="btn btn-sm btn-primary">
                Edit
              </a>

              {{-- Form Delete --}}
              <form action="{{ route('task.destroy', $task->id) }}"
                    method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn xóa task này?');">
                @csrf
                @method('DELETE')
                {{-- chuyển user_id để redirect về đúng User --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Chưa có task nào</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
      ← Quay về danh sách User
    </a>
  </div>
@endsection
