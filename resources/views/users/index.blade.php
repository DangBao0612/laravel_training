{{-- resources/views/users/index.blade.php --}}
@extends('layouts.lbd')

@section('content')
  <div class="container-fluid">
    <h3 class="mt-4">Danh sách User</h3>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Thêm User</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên</th>
          <th>Email</th>
          <th># Task</th>
          <th>Danh sách Task</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->tasks->count() }}</td>
            <td>
              @if($user->tasks->isEmpty())
                <em>Chưa có task</em>
              @else
                <ul class="mb-0 ps-3 list-unstyled">
                  @foreach($user->tasks as $task)
                    <li>{{ $task->title }}</li>
                  @endforeach
                </ul>
              @endif
            </td>
            <td class="d-flex gap-1">
              <!-- Nút Xem Task chi tiết -->
              <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">Task</a>
              <!-- Nút Sửa -->
              <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
              <!-- Nút Xóa -->
              <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
