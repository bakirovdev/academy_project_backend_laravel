<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GroupRepositoryInterface;
use App\Http\Requests\CreateUpdateGroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    function __construct(
        private GroupRepositoryInterface $groupRepository
    ){}

    function getAllGroup(){
        return $this->groupRepository->getAllGroup();
    }

    function createGroup(CreateUpdateGroupRequest $request){
        return $this->groupRepository->createGroup($request);
    }

    function updateGroup($id, CreateUpdateGroupRequest $request){
        return $this->groupRepository->updateGroup($id, $request);
    }
}
