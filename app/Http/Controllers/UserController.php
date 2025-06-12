<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }
  
    // Xử lý lưu user mới
    public function create()
    {
        return view('admin.user.create');
    }
    // Xử lý lưu user mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Thêm người dùng thành công');
    }

    // Form sửa user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // Xử lý cập nhật user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Cập nhật người dùng thành công');
    }

    // Xóa user
    public function destroy($id)
    {
        // Tìm user theo ID
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found.');
        }
    
        // Xóa user
        $user->delete();
    
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
    }
}
