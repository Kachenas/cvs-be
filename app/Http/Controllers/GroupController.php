<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Requests\DeleteGroupRequest;
use App\Services\GroupService;

class GroupController extends Controller
{

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function viewGroups()
    {
      return $this->groupService->viewGroups();
    }

    public function createGroup(CreateGroupRequest $request) 
    {
       return $this->groupService->createGroup($request->validated());
    }

    public function updateGroup(UpdateGroupRequest $request) 
    {
       return $this->groupService->updateGroup($request->validated());
    }

    public function deleteGroup(DeleteGroupRequest $request) 
    {
       return $this->groupService->deleteGroup($request->validated());
    }
}
