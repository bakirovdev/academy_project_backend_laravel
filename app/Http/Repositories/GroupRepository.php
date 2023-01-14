<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\GroupRepositoryInterface;
use App\Http\Resources\GroupResource;
use App\Http\Resources\UniversalResource;
use App\Models\Group;
use App\Models\GroupTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupRepository implements GroupRepositoryInterface {
    function __construct(
        private Group $group,
        private GroupTime $groupTime,
    ){}

    function getAllGroup()
    {
        $search = request('search', "");
        $data = $this->group
            ->with(['course', 'groupTeacher.user:id,full_name'])
            ->where('title', "ILIKE", "%$search%")
            ->get();
        return GroupResource::collection($data);
    }

    function createGroup($request){
        DB::beginTransaction();
        try {
            $group = $this->group->create([
                'title' => $request->title,
                'course_id' => $request->course_id
            ]);
            $times = $request->times;
            $dateTime = date('Y-m-d H:i:s');
            $timeData = [];
            foreach ($times as $id) {
                $timeData[] =
                [
                    'group_id' => $group->id,
                    'time_id' => $id,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime
                ];
            }

            $times = $this->groupTime->insert($timeData);
            DB::commit();
            return response()->json(['message' => "Group has successfully created"]);
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => "Something goes wrong please try again.",
                "error" => $error->getMessage(),
                "File" => $error->getFile(),
                "line" => $error->getLine(),
            ]);
        }
    }

    function updateGroup($id, $request){
        DB::beginTransaction();
        try {
            $group = $this->group->where('id', $id)->first();
            $group->title = $request->title;
            $group->save();
            $times = $request->times;
            $dateTime = date('Y-m-d H:i:s');
            $timeData = [];
            $haveTime = $this->groupTime->where('group_id', $group->id)->whereIn('time_id', $times)->pluck('id')->toArray();
            $this->groupTime->where('group_id', $group->id)->whereNotIn('time_id', $haveTime)->update(['active' => false]);
            $createdTime = array_diff($times, $haveTime);
            $createdTime = array_merge($createdTime);

            foreach ($createdTime as $id) {
                $timeData[] =
                [
                    'group_id' => $group->id,
                    'time_id' => $id,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime
                ];
            }
            $times = $this->groupTime->insert($timeData);
            DB::commit();
            return response()->json(['message' => "Group has successfully updated"]);
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => "Something goes wrong please try again.",
                "error" => $error->getMessage(),
                "File" => $error->getFile(),
                "line" => $error->getLine(),
            ]);
        }
    }
    public function findGroup($id){
        $data = $this->group
            ->with(['course', 'groupTeacher.user:id,full_name'])
            ->where('id', $id)
            ->first();
        return GroupResource::make($data);
    }

    public function getAuthGroup(){
        $user = Auth::user();
        $search = request('search', "");
        $data = $this->group
            ->whereHas('groupTeacher', function($query) use ($user){
                return $query->where('id', $user->id);
            })
            ->with(['course', 'groupPrice'])
            ->where('title', "ILIKE", "%$search%")
            ->get();
        return GroupResource::collection($data);
    }



}
