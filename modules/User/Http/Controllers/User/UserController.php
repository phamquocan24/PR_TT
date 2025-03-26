<?php

namespace Modules\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Modules\User\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tham số sắp xếp từ request
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        // Danh sách cột có thể sắp xếp
        $sortableColumns = ['id', 'first_name', 'last_name', 'email', 'role', 'last_login', 'created_at'];

        // Kiểm tra nếu cột không hợp lệ, đặt lại thành 'id'
        if (!in_array($sortBy, $sortableColumns)) {
            $sortBy = 'id';
        }

        // Tạo query
        $query = User::query();

        // Thêm tìm kiếm nếu có
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Lấy tổng số người dùng
        $totalUsers = $query->count();

        // Lấy danh sách người dùng với phân trang
        $users = $query->orderBy($sortBy, $sortOrder)->paginate($perPage);

        // Thêm thông tin cho view
        $roles = [
            UserRole::ADMINISTRATOR => 'Admin',
            UserRole::MEMBER => 'Member'
        ];

        return view('user::admin.users.index', compact('users', 'sortBy', 'sortOrder', 'perPage', 'search', 'totalUsers', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = [
            UserRole::ADMINISTRATOR => 'Admin',
            UserRole::MEMBER => 'Member'
        ];

        return view('user::admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer'
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được tạo thành công');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user::admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = [
            UserRole::ADMINISTRATOR => 'Admin',
            UserRole::MEMBER => 'Member'
        ];

        return view('user::admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|integer'
        ]);

        $userData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'role' => $validated['role']
        ];

        // Chỉ cập nhật mật khẩu nếu được cung cấp
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Không cho phép xóa chính mình
            if (auth()->id() == $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không thể xóa tài khoản của chính mình'
                ], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Người dùng đã được xóa thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa người dùng: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk destroy resources from storage.
     */
    public function bulkDestroy(Request $request)
    {
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            return redirect()->back()->with('error', 'Không có người dùng nào được chọn để xóa.');
        }

        // Không cho phép xóa chính mình
        if (in_array(auth()->id(), $userIds)) {
            return redirect()->back()->with('error', 'Bạn không thể xóa tài khoản của chính mình.');
        }

        try {
            // Ensure the user IDs are integers
            $userIds = array_map('intval', $userIds);

            // Delete users
            User::whereIn('id', $userIds)->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'Đã xóa thành công ' . count($userIds) . ' người dùng.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi khi xóa người dùng: ' . $e->getMessage());
        }
    }
}
