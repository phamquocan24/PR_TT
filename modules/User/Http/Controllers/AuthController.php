<?php

namespace Modules\User\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        // Middleware để bảo vệ các route cần xác thực
        $this->middleware('auth:admin', ['except' => ['getLogin', 'postLogin', 'getReset', 'postReset']]);
    }

    public function getLogin()
    {
        return view('user::auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Thông tin đăng nhập không hợp lệ'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Không thể tạo token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getLogout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['success' => 'Đăng xuất thành công']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Không thể đăng xuất người dùng'], 500);
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
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => 'Mật khẩu đã được đặt lại thành công']);
    }
}
