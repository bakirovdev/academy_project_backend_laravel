<?php

namespace App\Http\Interfaces;

interface GroupLessonRepositoryInterface {
    function startLesson($request);
    function attendance($request);
    function getAttendance($id);
}
