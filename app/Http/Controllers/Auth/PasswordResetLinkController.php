<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view(isAdminUrlRequest() ? 'admin.auth.forgot-password' : 'auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $guard = $request->is('admin*') ? 'admins' : null;
        $status = Password::broker($guard)->sendResetLink($request->only('email'));

        if($request->ajax()) {
            return response()->json(['status' =>  __($status)], $status == Password::PASSWORD_RESET ? 200 : 302);
        }

        session()->flash('status', __($status));
        return back();

    }
}
