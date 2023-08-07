<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Group;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;


class AdminGroupService extends BaseService
{
    protected $users;
    protected $groups;
    protected $vouchers;

    public function __construct(User $users,Group $groups,Voucher $vouchers)
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->vouchers = $vouchers;
    }

    /**
     * 
     * Only show groups assign to him as the Admin
     */
    public function showUserGroup()
    {
        return $this->executeFunction(function () {
            
            //get users only assign to him and their voucher codes
            $ids = $this->users->where('group_id',Auth::user()->id)
                   ->where('id','!=',Auth::user()->id)->pluck('id');

            return $this->vouchers->getUserWithVoucher($ids);
        });  
    }

    public function assignUserGroup($data)
    {
        return $this->executeFunction(function () use ($data) {

            //1 = Admin, 2 = GroupAdmin, 3 = SuperAdmin, 0 = remove from group

            if (Auth::user()->user_role == 2 || Auth::user()->user_role == 3) {
                
                $user = $this->users->find($data['user_id']);

                if ($user->group_id !== null && $user->group_id != 0) {
                    return "User is already assign to a group!";
                }
    
                $success = $user->where('id',$data['user_id'])
                            ->update(['group_id' => $data['group_id']]);

                if ($success) {
                    return "User is allocated to this group!";
                } else {
                    return "There was a problem while assigning this user to a group!";
                }
                
            }
            return "You are not allowed to do this action!";

        });
    }

    public function removeUserGroup(array $data)
    {
        return $this->executeFunction(function () use ($data) {

            // $ids = array_column($data, 'id');  
            // $this->users->whereIn('id', $ids)->delete();
            // return "user is deleted";
            $user = $this->users->where('id',$data['user_id'])
                    ->where('group_id',$data['group_id'])->count();

            if ($user == 0) {
                return "User does not belong to this Group!";
            }

            $user_remove = $this->users->where('id',$data['user_id'])
                           ->where('group_id',$data['group_id'])
                           ->update(['group_id' => 0]);

            if ($user_remove) {
                return "User is remove from the group!";
            }
            return "There was a problem while removing this user to the group!";
        });
    }

    public function showUnallocatedUser()
    {
        return $this->executeFunction(function () {
            return $this->users
                    ->where('group_id', 0)
                    ->orWhereNull('group_id')
                    ->where('id','!=',Auth::user()->id)
                    ->where('user_role','!=',2)
                    ->get();
        });
    }

    public function showGroups()
    {
        return $this->executeFunction(function () {
            return $this->groups->all();
        });
    }

}