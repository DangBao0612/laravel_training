<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = DB::table('tasks')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->query('user_id');
        // lấy tên user để hiển thị
        $user = User::findOrFail($userId);

        return view('tasks.create', compact('userId', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate đầu vào
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        // Insert bản ghi mới
        DB::table('tasks')->insert([
            'user_id'    => $request->input('user_id'),
            'title'      => $request->input('title'),
            'completed'  => $request->has('completed') ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now(),
            ]);

        // Chuyển về trang index với flash message
        return redirect()
            ->route('users.show', $request->input('user_id'))
            ->with('success', 'Task đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = DB::table('tasks')->find($id);

        if (! $task) {
            abort(404, 'Task không tồn tại');
        }

        // Quay về trang User show sau khi view xong, lấy thêm user_id
        $userId = $task->user_id;

        // Trả view resources/views/tasks/show.blade.php
        return view('tasks.show', compact('task', 'userId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = DB::table('tasks')->find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate đầu vào
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        DB::table('tasks')->where('id', $id)->update([
        'title'     => $request->input('title'),
        'completed' => $request->has('completed') ? 1 : 0,
        'updated_at'=> now(),
        ]);
    // redirect về user show
        return redirect()
        ->route('users.show', $request->input('user_id'))
        ->with('success', 'Task đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::table('tasks')->where('id', $id)->delete();

        return redirect()
            ->route('users.show', $request->input('user_id'))
            ->with('success', 'Task đã bị xóa.');
    }
}
