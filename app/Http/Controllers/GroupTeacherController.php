<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GroupTeacherRepositoryInterface;
use Illuminate\Http\Request;

class GroupTeacherController extends Controller
{
    function __construct(
        private GroupTeacherRepositoryInterface $groupTeacherRepository
    ){}

    function getGroupTeachers($id){
        return $this->groupTeacherRepository->getGroupTeachers($id);
    }

    function addTeacher(Request $request){
        return $this->groupTeacherRepository->addTeacher($request);
    }
}
