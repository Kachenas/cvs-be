<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserLoginService;

class UserLoginController extends Controller
{
    /* 
    
    1. User can register (full name, email, password)
    2. User can generate voucher code
    3. User can only generate 10 voucher code
    4. User can only belong to 1  group
    5. User can delete own voucher code
    6. Inform user that he can only generate 10 voucher code.
    
    */

    /**
     * Create a new Service instance.
     *
     * @return void
     */
    protected $userLoginService;

    public function __construct(UserLoginService $userLoginService)
    {
        $this->userLoginService = $userLoginService;
    }

    public function userLogin(UserLoginRequest $request) 
    {
        return $this->userLoginService->userLogin($request->validated());
    }

    public function userRegistration(UserRequest $request) 
    {
        return $this->userLoginService->userRegistration($request->validated());
    }
}