<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Requests\StudentCreateRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected StudentRepositoryInterface $studentRepository;
    function __construct(StudentRepositoryInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }
    function index(){
        return $this->studentRepository->getAllStudents();
    }

    function store(StudentCreateRequest $request){
        return $this->studentRepository->createStudent($request);
    }

    function update($id, StudentCreateRequest $request){
        return $this->studentRepository->updateStudent($id, $request);
    }
}
