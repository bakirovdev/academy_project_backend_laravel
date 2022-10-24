<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GroupStudentRepositoryInterface;
use App\Http\Requests\CreateUpdateGroupStudent;
use Illuminate\Http\Request;

class GroupStudentController extends Controller
{
    function __construct(
        private GroupStudentRepositoryInterface $groupStudentRepository
    ){}

    function getGroupStudents($id){
        return $this->groupStudentRepository->getGroupStudents($id);
    }

    function getUnjoinedStudents(){
        $groupId = request('group_id', 0);
        $search = request('search', '');
        return $this->groupStudentRepository->getUnjoinedStudents($groupId, $search);
    }

    function addStudent(CreateUpdateGroupStudent $request){
        return $this->groupStudentRepository->addStudent($request);
    }

    function updateActive($id){
        return $this->groupStudentRepository->updateActive($id);
    }
}
