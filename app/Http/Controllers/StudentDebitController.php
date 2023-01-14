<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StudentDebitRepositoryInterface;
use Illuminate\Http\Request;

class StudentDebitController extends Controller
{
    function __construct(
        private StudentDebitRepositoryInterface $studentDebitRepository
    ){}

    function getStudents(){
        $request = request()->all();
        return $this->studentDebitRepository->getStudents($request);
    }
    function payment(Request $request){
        return $this->studentDebitRepository->payment($request);
    }
}
