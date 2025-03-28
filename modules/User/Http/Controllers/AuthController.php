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
use Modules\User\Enums\UserRole;

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
            \Log::info('Đang thử JWT auth với credentials');
            if (!auth('api')->attempt($credentials)) {
                \Log::info('JWT auth thất bại');
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
            }

            \Log::info('JWT auth thành công');

            // Cập nhật thời gian đăng nhập cuối
            $user = auth('api')->user();
            $user->last_login = now();
            $user->save();
            // Lấy token JWT và lưu vào session
            $token = JWTAuth::fromUser($user);
            session(['jwt_token' => $token]);

            \Log::info('JWT token đã được lưu vào session');

            // Nếu yêu cầu là AJAX hoặc mong đợi JSON
            if ($request->expectsJson()) {
                $token = JWTAuth::fromUser($user);
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            }

            return view('admin::dashboard.index');

        } catch (JWTException $e) {
            \Log::error('JWT Error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Không thể tạo token'], 500);
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại sau.']);
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

        // Cập nhật thời gian đăng nhập cuối
        $user = auth('api')->user();
        $user->last_login = now();
        $user->save();

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::MEMBER,
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
            return response()->json(['error' => 'Không thể làm mới token: ' . $e->getMessage()], 401);
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
