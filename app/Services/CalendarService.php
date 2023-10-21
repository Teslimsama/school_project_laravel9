<?php

namespace App\Services;

use App\Lesson;
use Illuminate\Support\Facades\Session;

class CalendarService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons   = Lesson::with('class', 'teacher')
            ->get();

        foreach ($timeRange as $time) {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day) {

                $userRole = Session::get('role_name') ?? '';
                $classId = Session::get('class_id') ?? '';
                $teacherId = Session::get('teacher_id') ?? '';
                // $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
                if ($userRole === "Admin" || $userRole === 'Super Admin') {

                    $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();
                } elseif ($userRole === 'Student') {
                    $lesson = $lessons->where([
                        'weekday' => $index,
                        'class_id' => $classId
                    ])->where('start_time', $time['start'])->first();
                } else {
                    // this is a teacher 
                    $lesson = $lessons->where([
                        'weekday' => $index,
                        'teacher_id' => $teacherId
                    ])->where('start_time', $time['start'])->first();
                }
                if ($lesson) {
                    array_push($calendarData[$timeText], [
                        'class_name'   => $lesson->class->name,
                        'teacher_name' => $lesson->teacher->name,
                        'rowspan'      => $lesson->difference / 30 ?? '',
                        'subject_name' => $lesson->scopeGetSubjectName($lesson->subject_id)->name ?? ''
                    ]);
                } else if (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()) {
                    array_push($calendarData[$timeText], 1);
                } else {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }
}
