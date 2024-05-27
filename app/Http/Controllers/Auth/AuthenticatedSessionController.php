<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return view(isAdminUrlRequest() ? 'admin.auth.login' : 'auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $redirect = isAdminUrlRequest() ? RouteServiceProvider::DASHBOARD : RouteServiceProvider::HOME;
        return redirect()->intended($redirect);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard(isAdminUrlRequest() ? 'admin' : null)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(isAdminUrlRequest() ? '/admin/login' : 'login');
    }
}
