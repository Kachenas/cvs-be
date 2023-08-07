<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\AssignGroupAdminRequest;
use App\Http\Requests\SuperAdminCreateGroupRequest;
use App\Http\Requests\SuperAdminDeleteGroupRequest;
use App\Http\Requests\UpdateUserGroupRequest;
use App\Services\SuperAdminUserService;
use App\Services\AdminGroupService;

class SuperAdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $superAdminService;
    protected $adminGroupService;

    public function __construct(SuperAdminUserService $superAdminService,AdminGroupService $adminGroupService)
    {
        $this->superAdminService = $superAdminService;
        $this->adminGroupService = $adminGroupService;
    } 

    public function viewUsers() 
    {
        return $this->superAdminService->viewUsers();
    } 

    public function viewAdmins() 
    {
        return $this->superAdminService->viewAdmins();
    }

    public function viewGroupAdmin() 
    {
        return $this->superAdminService->viewGroupAdmin();
    }

    public function assignGroupAdmin(AssignGroupAdminRequest $request) 
    {
       return $this->adminGroupService->assignUserGroup($request->validated());
    } 

    public function assignAdminGroup(AssignGroupAdminRequest $request) 
    {
       return $this->superAdminService->assignAdminGroup($request->all());
    }

}
