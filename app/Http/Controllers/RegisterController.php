<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Services\{ UserService, CompanyService };

/**
 * @property UserService $_userService
 */
class RegisterController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }

    public function create()
    {
        $companies = (new CompanyService())->all();
        return view('auth.register',compact("companies"));
    }

    public function store(StoreRegisterRequest $storeRegisterRequest)
    {
        $this->_userService->store();
        return redirect('/dashboard');
    }
}
