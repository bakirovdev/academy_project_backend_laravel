<?php

namespace App\Http\Interfaces;

interface TimeRepositoryInterface {
    function getAllTimes();
    function createTime($request);
    function updateTime( $id, $request);
    function updateActive($id);
}
