<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TimeRepositoryInterface;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    function __construct(
        private TimeRepositoryInterface $timeRepository
    ){}

    function getAllTimes(){
        return $this->timeRepository->getAllTimes();
    }

    function createTime(Request $request){
        return $this->timeRepository->createTime($request);
    }

    function updateTime($id, Request $request){
        return $this->timeRepository->updateTime($id, $request);
    }

    function updateActive($id){
        return $this->timeRepository->updateActive($id);
    }
}
