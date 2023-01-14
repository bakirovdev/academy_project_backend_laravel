<?php

namespace App\Http\Interfaces;

interface StudentRepositoryInterface {
    function getAllStudents();
    function createStudent($request);
    function updateStudent($id, $request);
    function checkStudent($id, $status);
}
