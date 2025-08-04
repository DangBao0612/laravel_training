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
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              <!-- Nút Xem chi tiết (show) -->
              <a href="{{ route('users.show', $user) }}"
                 class="btn btn-sm btn-info">
                View
              </a>
              <!-- Nút Sửa (edit) và Xóa (delete) -->
              <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">
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
