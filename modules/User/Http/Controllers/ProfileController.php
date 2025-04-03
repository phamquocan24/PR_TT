<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Enums\StatusResponse;
use Modules\User\Entities\User;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     *
     * @return Response
     */
    public function index()
    {
        return view('user::profile.index');
    }

    /**
     * Update the user account information.
     *
     * @param Request $request
     * @return Response
     */
    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('user.profile.index')
            ->with([
                'message' => 'Profile updated successfully.',
                'status' => StatusResponse::SUCCESS,
                'tab' => 'account'
            ]);
    }

    /**
     * Update the user password.
     *
     * @param Request $request
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.profile.index')
            ->with([
                'message' => 'Password updated successfully.',
                'status' => StatusResponse::SUCCESS,
                'tab' => 'password'
            ]);
    }
}
