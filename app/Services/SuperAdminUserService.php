<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;


class SuperAdminUserService extends BaseService
{
    protected $users;
    protected $groups;

    public function __construct(User $users, Group $groups)
    {
        $this->users = $users;
        $this->groups = $groups;
    }

    public function viewUsers()
    {
        return $this->executeFunction(function () {

            if (Auth::user()->user_role == 3) {
                return $this->users->viewUsers();
            }
            return "You are not allowed to do this action!";
        });
    }

    public function viewGroupAdmin()
    {
        return $this->executeFunction(function () {
            //return $this->users->where('user_role',2)->get();
            if (Auth::user()->user_role == 3) {
                return $this->users->viewGroupAdmin();
            }
            return "You are not allowed to do this action!";
        });
    }

    public function viewAdmins()
    {
        return $this->executeFunction(function () {
            if (Auth::user()->user_role == 3) {
                //return $this->users->where('user_role',2)->get();
                return $this->users->viewAdmins();
            }
            return "You are not allowed to do this action!";
        });
    }

    public function assignAdminGroup(array $data)
    {
        return $this->executeFunction(function () use ($data) {
            
            if (Auth::user()->user_role == 3) {
            
                $update = $this->groups->where('id', $data['group_id'])->update([
                    'group_admin_id' => $data['user_id']
                ]);

                if ($update) {
                    return "Succesfully assign Admin to group";
                }
                return "There was an error while assigning admin to this Group!";

            }
            return "You are not allowed to do this action!";
           
        });
    }

}