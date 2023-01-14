<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\TimeRepositoryInterface;
use App\Http\Resources\UniversalResource;
use App\Models\Time;

class TimeRepository implements TimeRepositoryInterface {
    function __construct(
        private Time $time
    ){}

    function getAllTimes()
    {
        return $this->time->get();
    }

    function createTime($request){
        $this->time->create([
            'week' => $request->week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(['message' => 'The new time has successfully created'], 200);
    }

    function updateTime($id,  $request){
        $time = $this->time->find($id);
        $time->update([
            'week' => $request->week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        $time->save();

        return response()->json(['message' => 'The time has successfully updated'], 200);
    }
    function updateActive($id){
        $time = $this->time->where('id', $id)->first();
        $time->active = !$time->active;
        $time->save();

        return response()->json(['message' => 'The time has successfully updated'], 200);
    }
}
