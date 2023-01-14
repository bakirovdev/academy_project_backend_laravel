<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(){
        return $this->userRepository->getAllUser();
    }

    public function store(Request $request){
        return $this->userRepository->createUser($request);
    }
    public function update($id, Request $request){
        return $this->userRepository->updateUser($id, $request);
    }

    public function authUser(Request $request){
        return $this->userRepository->authUser($request);
    }
    public function updateActive($id){
        return $this->userRepository->updateActive($id);
    }
}
