<?php

namespace App\Http\Interfaces;

interface GroupTeacherRepositoryInterface {
    function getGroupTeachers($id);
    function addTeacher($request);
}
