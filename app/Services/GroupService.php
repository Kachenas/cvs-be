<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;


class GroupService extends BaseService
{
    protected $users;
    protected $groups;

    public function __construct(Group $groups, User $users)
    {
        $this->groups = $groups;
        $this->users = $users;
    } 

    public function viewGroups()
    {
        return $this->executeFunction(function () {
            if (Auth::user()->user_role == 3) {
                return $this->groups->viewGroups();
            }
            return "You are not allowed to do this action!";
        });
    }

    public function createGroup(array $data)
    {
        return $this->executeFunction(function () use ($data) {
            
            if (Auth::user()->user_role == 3) {
                $group = $this->groups->create($data);
                if ($group) {
                    return $group;
                }
                return "There was an error while creating a new Group!";
            }
            return "You are not allowed to do this action!";
            
        });
    }

    public function updateGroup(array $data)
    {
        return $this->executeFunction(function () use ($data) {
            
            if (Auth::user()->user_role == 3) {
                $update = $this->groups->where('id', $data['id'])->update($data);
                if ($update) {
                    return "Succesfully update Group Data";
                }
                return "There was an error while updating this Group!";
            }
            return "You are not allowed to do this action!";
           

        });
    }

    public function deleteGroup(array $data)
    {
        return $this->executeFunction(function () use ($data) {

            if (Auth::user()->user_role == 3) {
                $groupId = $data['id'];
                $deleteUser = $this->users->where('group_id',$groupId)->update(['group_id' => '']);
                if ($deleteUser == 0) {
                    $this->groups->where('id', $groupId)->delete();
                    return "This user group is deleted!";
                }
                return "There was an error while deleting this group!";
            }
            return "You are not allowed to do this action!";
        });
    }
}