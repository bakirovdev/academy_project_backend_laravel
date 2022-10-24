<?php

namespace App\Http\Interfaces;

use App\Http\Requests\CreateUpdateGroupStudent;

interface GroupStudentRepositoryInterface {
    function getGroupStudents($id);
    function getUnjoinedStudents($groupId, $search);
    function addStudent(CreateUpdateGroupStudent $request);
    function updateActive($id);
}
