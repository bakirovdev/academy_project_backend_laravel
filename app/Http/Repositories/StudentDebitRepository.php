<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\StudentDebitRepositoryInterface;
use App\Http\Resources\StudentDebitResource;
use App\Models\Attendance;
use App\Models\Group;
use App\Models\GroupPrice;
use App\Models\GroupStudent;
use App\Models\Student;
use App\Models\StudentGroupDebit;
use App\Models\StudentMoney;
use Illuminate\Support\Facades\DB;

class StudentDebitRepository implements StudentDebitRepositoryInterface {
    function __construct(
        private StudentMoney $studentMoney,
        private GroupStudent $groupStudent,
        private Group $group,
        private GroupPrice $groupPrice,
        private Attendance $attendance,
        private Student $student,
        private StudentGroupDebit $studentGroupDebit
    ){}

    function getStudents($request){
        $search = $request['search'] ?? '';
        $groupId = $request['groups'] ?? [];
        $data = $this->student
            ->with([
                'student_money:student_id,id,value',
                'group_students:id,student_id,group_id,created_at as date',
                'group_students.group:id,title'
            ])
            ->where(function ($query) use ($search){
                $query->where('first_name', "ILIKE", "%$search%")
                    ->orWhere('last_name', "ILIKE", "%$search%");
            })
            ->whereHas('group_students', function ($query) use ($groupId) {
                if (count($groupId) > 0) {
                    return $query->whereIn('group_id', $groupId);
                }
            })
            ->orderBy('id')
            ->paginate();
        return StudentDebitResource::collection($data);
    }

    function payment($request){
        $value =  abs($request->value);
        $studentId =  $request->student_id;
        DB::beginTransaction();
        try {
            $studentMoney = $this->studentMoney->where('student_id', $studentId)->first();
            if (!$studentMoney) {
                $studentMoney = $this->studentMoney->create([
                    "student_id" => $studentId,
                    "value" => abs($value),
                    "date" => date('Y-m-d H:i:s')
                ]);
            }
            $studentMoney->value = $studentMoney->value + $value;
            $studentGroups = $this->groupStudent->where('student_id', $studentId)->where('active', true)->get()->toArray();
            for ($i=0; $i < count($studentGroups); $i++) {
                $groupPrice = $this->groupPrice->where('id',  $studentGroups[$i]['group_id'])->where('active', true)->first();
                $attendance = $this->attendance
                    ->where('group_id', $studentGroups[$i]['group_id'])
                    ->where('attend', true)
                    ->where('student_id', $studentGroups[$i]['student_id'])
                    ->where('payed', false)
                    ->groupBy('month', 'year')
                    ->select('month', 'year')
                    ->get()->toArray();
                for ($b=0; $b < count($attendance) ; $b++) {
                    if (($studentMoney->value - ($groupPrice->monthly_price - $studentGroups[$i]['bonus'])) < 0) {
                        return response()->json(['message' => "The amount paid is insufficient"], 400);
                    }
                    $this->studentGroupDebit->create([
                        "value" => $groupPrice->monthly_price - $studentGroups[$i]['bonus'],
                        "student_id" => $studentGroups[$i]['student_id'],
                        "group_id" => $studentGroups[$i]['group_id'],
                        'bonus' => abs($studentGroups[$i]['bonus']),
                        'month' => $attendance[$b]['month'],
                        'year' => $attendance[$b]['year'],
                    ]);
                    $this->attendance
                        ->where('group_id', $studentGroups[$i]['group_id'])
                        ->where('attend', true)
                        ->where('student_id', $studentGroups[$i]['student_id'])
                        ->where('payed', false)
                        ->where('month', $attendance[$b]['month'])
                        ->where('year', $attendance[$b]['year'])
                        ->update(['payed'=> true]);
                    $studentMoney->value = $studentMoney->value - ($groupPrice->monthly_price - $studentGroups[$i]['bonus']);
                }
            }
            $studentMoney->save();
            DB::commit();
            return response()->json(['message' => "Payment  have completely payed"], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                "message" => "Something wrong",
                "error" => $exception->getMessage(),
                "file" => $exception->getFile(),
                "line" => $exception->getLine(),
                ], 400);
        }
    }
}
