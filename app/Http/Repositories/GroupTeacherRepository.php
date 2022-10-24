<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\GroupTeacherRepositoryInterface;
use App\Http\Resources\UniversalResource;
use App\Models\Group;
use App\Models\GroupTeacher;
use Illuminate\Support\Facades\DB;

class GroupTeacherRepository implements GroupTeacherRepositoryInterface {
    function __construct(
        private GroupTeacher $groupTeacher,
        private Group $group
    ){}

    function getGroupTeachers($id)
    {
        $data = $this->groupTeacher->with(['user:id,full_name'])->where('group_id', $id)->get();
        return UniversalResource::collection($data);
    }

    function addTeacher($request)
    {
        $groupId = $request->group_id;
        $userId = $request->user_id;
        DB::beginTransaction();
        try {
            $activeTeacher = $this->groupTeacher->where('active', true)->where('group_id', $groupId)->first();
            if ($activeTeacher && $userId == $activeTeacher->user_id) {
                return response()->json(['message' => 'Your new teacher is actually active. Please choice another teacher!!'], 400);
            }
            $this->groupTeacher->where('active', true)->where('group_id', $groupId)->update(['active' => 0]);

            $this->groupTeacher->create([
                'user_id' => $userId,
                'group_id' => $groupId,
            ]);
            DB::commit();
            return response()->json(['message' => 'Your new teacher has successfully attached'], 200);
        } catch (\Exception $error) {
            DB::rollBack();
            return $error;
        }
    }
}
