<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'getLogin', 'postLogin', 'getReset', 'postReset', 'login', 'register'
        ]]);
    }

    // Web auth methods - sử dụng cho admin panel
    public function getLogin()
    {
        return view('user::auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth('api')->attempt($credentials)) {
            return redirect()->intended(route('admin.users.index'));
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
    }

    public function getLogout(Request $request)
    {
        try {
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (auth('api')->check()) {
                // Xử lý logout với JWT
                try {
                    JWTAuth::parseToken()->invalidate();
                } catch (\Exception $e) {
                    // Bỏ qua lỗi nếu không có token hợp lệ
                }

                auth('api')->logout();
            }

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
        // Logic xử lý reset password
        return redirect()->route('admin.login')->with('success', 'Mật khẩu đã được đặt lại');
    }

    // API auth methods
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
            return $this->respondWithToken($token);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể làm mới token'], 401);
        }
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            'user' => auth('api')->user()
        ]);
    }
}
