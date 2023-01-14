<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UniversalResource;
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
        $search = request('search');
        $data = $this->user->where('username', "ILIKE", $search)->orWhere('full_name', 'ILIKE', $search)->paginate();
        return UniversalResource::collection($data);
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
            'password' => bcrypt($request->phone_number) ?? $user->phone_number,
        ]);
        $user->save();
        return response()->json(['message' => 'The user has updated']);
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
            return response()->json(["access_token" => $token, "error" => false], 200);
        } else {
            return response()->json(['message' => 'Логин ёки парол нотўғри!', 'error' => true], 403, []);
        }
    }

    public function updateActive($id){
        $user = $this->user->where('id', $id)->first();
        $user->active = !$user->active;
        $user->save();
        return response()->json(['message' => 'The user has updated']);
    }
}
