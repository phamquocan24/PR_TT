<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Modules\User\Enums\UserRole;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'getLogin', 'postLogin', 'getReset', 'postReset'
        ]]);
    }

    // Web auth methods - sử dụng cho admin panel
    public function getLogin()
    {
        return view('user::auth.login');
    }

    public function postLogin(Request $request)
    {
        \Log::info('Đang thử đăng nhập với:', $request->only('email'));

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            \Log::info('Validation failed:', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        try {
            \Log::info('Đang thử auth với credentials');
            if (!Auth::attempt($credentials)) {
                \Log::info('Auth thất bại');
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
            }

            \Log::info('Auth thành công');

            // Cập nhật thời gian đăng nhập cuối
            $user = Auth::user();
            $user->last_login = now();
            $user->save();

            // Nếu yêu cầu là AJAX hoặc mong đợi JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'user' => $user
                ]);
            }

            return redirect()->route('admin.dashboard.index');

        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Có lỗi không xác định: ' . $e->getMessage()]);
        }
    }

    public function getLogout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Xử lý phản hồi dựa trên loại yêu cầu
            if ($request->expectsJson()) {
                // API response
                return response()->json(['message' => 'Đăng xuất thành công']);
            } else {
                // Web response - chuyển hướng đến trang login
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            // Xử lý lỗi
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Không thể đăng xuất: ' . $e->getMessage()], 500);
            }

            return back()->withErrors(['error' => 'Không thể đăng xuất. Vui lòng thử lại.']);
        }
    }

    public function getReset()
    {
        return view('user::auth.reset');
    }

    public function postReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công');
    }
}
