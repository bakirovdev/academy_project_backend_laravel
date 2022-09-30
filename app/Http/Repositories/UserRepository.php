<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUser()
    {
        return $this->user->all();
    }

    public function createUser($request){
        $user = $this->user->create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'full_name' => $request->full_name,
            'password' => bcrypt($request->password),
        ]);
        return response()->json(['message'=>'User has created'], 200);
    }

    public function updateUser($id, $request){
        $user = $this->user->where('id', $id)->first();
        $user->update([
            'username' => $request->username ?? $user->username,
            'full_name' => $request->full_name ?? $user->full_name,
            'phone_number' => $request->phone_number ?? $user->phone_number,
            'password' => $request->password ?? bcrypt($user->password),
        ]);
        return response()->json(['message' => 'The user has updated'], 200);
    }

    public function authUser($request){
        $password = $request->password;
        $username = $request->username;
        if (!(isset($username) && isset($password))) {
            return response()->json(['message' => 'Please enter username or password'], 400);
        }
        $user = $this->user->where('username', $username)->first();
        if (!$user) {
            return response()->json(['message' => 'None user found like this'], 400);
        }
        if (Hash::check($password, $user->password)) {
            $token = $user->createToken("SECRET")?->plainTextToken;
            return response()->json(["token" => $token, "error" => false], 200);
        } else {
            return response()->json(['message' => 'Логин ёки парол нотўғри!', 'error' => true], 403, []);
        }
    }
}
