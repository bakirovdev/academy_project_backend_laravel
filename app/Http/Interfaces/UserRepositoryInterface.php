<?php

namespace App\Http\Interfaces;

interface UserRepositoryInterface{
    function getAllUser();
    function createUser($request);
    function updateUser($id, $request);
    function authUser($request);
    function updateActive($id);
}
