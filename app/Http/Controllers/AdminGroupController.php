<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssignGroupAdminRequest;
use App\Services\AdminGroupService;

class AdminGroupController extends Controller
{
     /**
     * Create a new Service instance.
     *
     * @return void
     */
    protected $adminGroupService;

    public function __construct(AdminGroupService $adminGroupService)
    {
        $this->adminGroupService = $adminGroupService;
    }

    public function assignUserGroup(AssignGroupAdminRequest $request) 
    {
        return $this->adminGroupService->assignUserGroup($request->validated());
    }

    public function showUserGroup() 
    {
        return $this->adminGroupService->showUserGroup();
    }

    public function removeUserGroup(AssignGroupAdminRequest $request) 
    {
        return $this->adminGroupService->removeUserGroup($request->validated());
    }
    
    public function showUnallocatedUser() 
    {
        return $this->adminGroupService->showUnallocatedUser();
    }

    public function showGroups() 
    {
        return $this->adminGroupService->showGroups();
    }
}
