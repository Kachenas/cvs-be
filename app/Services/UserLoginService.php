<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserLoginService extends BaseService
{
    protected $userLogin;

    public function __construct(User $userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function userLogin(array $data)
    {
        return $this->executeFunction(function () use ($data) {

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){ 
                
                $user = Auth::user();
                $dataUser = $user->only(['id', 'email', 'user_role','first_name', 'middle_name','last_name']);
                $dataUser['token'] =  $user->createToken('MyApp')-> accessToken; 
    
                return $dataUser;
            } else { 
                
                if ($this->userLogin->where('email', $data['email'])->exists()) {
                    return "You entered an incorrect Password!";
                } else {
                    return "This email does not exist!";
                }
            } 

        });
    }

    public function userRegistration(array $data)
    {
        return $this->executeFunction(function () use ($data) {

            $user = $this->userLogin->create($data);
            $dataCred = [
                'info' =>  $user,
                'token' => $user->createToken('MyApp')->accessToken
            ];

            $to_name = $data['first_name'];
            $to_email = $data['email'];
            $message = " Hi " . $data['first_name'] . "!, congratulations on registering to our site!";
            $data = array('first_name'=> $data['first_name'],'middle_name' => $data['middle_name'], 'last_name' => $data['last_name']);
            Mail::send('emails.user-registered', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Congratulations');
            });

            return $dataCred;
            
        });
    }
}