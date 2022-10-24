<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\GroupLessonRepositoryInterface;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\GroupLesson;
use App\Models\GroupStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class GroupLessonRepository implements GroupLessonRepositoryInterface {
    function __construct(
        private GroupLesson $groupLesson,
        private Attendance $attendance,
        private Student $student,
        private Request $request,
        private GroupStudent $groupStudent
    ){}

    function startLesson($request)
    {
        DB::beginTransaction();
        try {
            $groupLesson = $this->groupLesson->create([
                'group_id' => $request->group_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => date('Y-m-d'),
                'month' => date('m'),
                'year' => date('Y'),
            ]);
            DB::commit();
            return response()->json(['message' => 'Lesson has successfully created', 'data' => $groupLesson]);
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json($error);
        }
    }

    function attendance($request){
        DB::beginTransaction();
        try {
            $groupLesson = $this->groupLesson->where('id', $request->group_lesson_id)->first();
            $attendance = $this->attendance->where('group_lesson_id', $groupLesson->id)->first();
            if ($attendance) {
                return response()->json(['message' => "You have already check this group"], 400);
            }
            $groupStudents = $this->groupStudent
                ->select('student_id')
                ->groupBY('student_id')
                ->where('group_id', $groupLesson->group_id)
                ->where('active', true)
                ->get()
                ->toArray();
            $students = $request->students ?? [];
            if (count($students) < 1) {
                return response()->json(['message' => "Please enter all details"], 400);
            }
            $insertStudents = [];
            $day = date('Y-m-d H:i:s');
            for ($i=0; $i < count($groupStudents) ; $i++) {
                for ($b=0; $b < count($students) ; $b++) {
                    if($groupStudents[$i]['student_id'] == $students[$b]['id']){
                        $insertStudents[] = [
                            'group_id' => $groupLesson->group_id,
                            'group_lesson_id' => $groupLesson->id,
                            'student_id' => $groupStudents[$i]['student_id'],
                            'attend' => $students[$b]['attend'],
                            'comment' => $students[$b]['attend'] ? $students[$b]['comment'] : null,
                            'month' => $groupLesson->month,
                            'year' => $groupLesson->year,
                            'date' => $groupLesson->date,
                        ];
                        continue;
                    }
                    if ((count($students)-1) == $b) {
                        $insertStudents[] = [
                            'group_id' => $groupLesson->group_id,
                            'group_lesson_id' => $groupLesson->id,
                            'student_id' => $groupStudents[$i]['student_id'],
                            'attend' => false,
                            'comment' => null,
                            'month' => $groupLesson->month,
                            'year' => $groupLesson->year,
                            'date' => $groupLesson->date,
                        ];
                    }
                }
            }
            $this->attendance->insert($insertStudents);
            DB::commit();
            return response()->json(['message' => "Actions successfully done"]);
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => "Something wrong ",
                'error' => $error->getMessage(),
                'line' => $error->getLine(),
                'file' => $error->getFile(),
            ], 400);
        }
    }
    function getAttendance($id){
        $students = $this->student->join('group_students', 'group_students.student_id', 'students.id')
            ->where('group_students.group_id', $id)
            ->where('active', true)
            ->select('students.id', 'first_name', 'last_name', 'group_students.created_at')
            ->orderBy('id')
            ->get()->toArray();
        Config::set('students', $students);
        $dates  = request('dates', []);
        $lesson = $this->groupLesson
            ->where('group_id', $id)
            ->where(function ($query) use ($dates) {
                if (count($dates)  > 0) {
                    return $query->whereBetween('date', $dates);
                }
            })
            ->orderByDesc('id')
            ->paginate(1);
        return AttendanceResource::collection($lesson);
    }
}










