<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use phpDocumentor\Reflection\Types\This;

/**
 * @property UserService $userService
 */
class LoginController extends Controller
{

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request)
    {
        return $this->userService->login();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
