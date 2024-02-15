<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timetable;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lesson;
use App\SchoolClass;
use App\Services\CalendarService;
use Carbon\Carbon;

class TimeTableController extends Controller
{
    public function Timetable(CalendarService $calendarService)
    {
        // Fetch all timetable data from the database
        $timetableData = lesson::all();

        // Group timetable events by day of the week and time slots
        $timetable = [];

        foreach ($timetableData as $event) {
            // $dayOfWeek = date('l', strtotime($event->event_date));
            $dayOfWeek = $event->event_date;
            $startTime = date('g:i a', strtotime($event->start_time));
            $endTime = date('g:i a', strtotime($event->end_time));

            $timetable[$dayOfWeek][$startTime] = $event->event_name;
        }


        $weekDays     = Lesson::WEEK_DAYS;
        $userType = auth()->user()->currentUserType();
        if (in_array($userType, config('enums.allowedUserTypes'))) {
            $calendarData = $calendarService->getAllCalendarWithAllFields($weekDays);
        } else {
            $calendarData = $calendarService->generateCalendarData($weekDays);
        }

        return view('timetable.timetable', compact('timetable', 'timetableData', 'weekDays', 'calendarData'));
    }

    // public function TimetableSave(Request $request)
    // {
    //     // Validate the form input
    //     $request->validate([
    //         'event_date' => 'required|date',
    //         'event_time' => 'required|date_format:H:i',
    //         'event_name' => 'required|string|max:255',
    //     ]);

    //     // Save the form data to the database
    //     Timetable::create([
    //         'event_date' => $request->event_date,
    //         'event_time' => $request->event_time,
    //         'event_name' => $request->event_name,
    //         // Add other necessary columns for your timetable
    //     ]);

    //     return redirect('/timetable')->with('success', 'Event added successfully!');
    // }
    /** Timetable add page */
    public function TimetableAdd()
    {
        $classes = DB::table('school_classes')->get();
        $weekDays     = Lesson::WEEK_DAYS;
        $teachers = Teacher::get(['full_name', 'id']);

        return view('timetable.add_timetable', compact('classes', 'weekDays', 'teachers'));
    }

    /** Timetable save record */
    public function TimetableSave(Request $request)
    {

        $request->validate([
            'day' => 'required|string',
            'time' => 'required|date_format:H:i',
            'subject' => 'required|string|max:255',
            'class'    => 'required|string',
            'teacher'    => 'required|string',

        ]);


        $time = explode(" ", $request->time)[0];

        dd($time);

        // convert dat int to string 
        $weekDays = Lesson::WEEK_DAYS;
        $convertedDay = $weekDays[$request->day];

        DB::beginTransaction();
        try {
            if (!empty($request->class)) {
                $Timetable = new Timetable;
                $Timetable->event_name   = $request->subject;
                $Timetable->class   = $request->class;
                $Timetable->event_time   = $request->time;
                $Timetable->teacher_name   = $request->teacher;
                $Timetable->event_date   = $convertedDay;
                $Timetable->save();


                Lesson::create([
                    'weekday' => $request->day,
                    'class_id' => $request->class,
                    'end_time' => Carbon::parse($request->time)->addMinutes(30)->toDate()->format('Y-m-d H:i:s'),
                    'teacher_id' => $request->teacher,
                    'start_time'  => $request->time,
                    'subject_id' => Subject::where('name', $request->subject)->first()->id,
                ]);

                // dd($request->day);

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new Timetable  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit Timetable */
    public function TimetableEdit($id)
    {
        $TimetableEdit = Timetable::where('id', $id)->first();
        $teachers = Teacher::get(['full_name', 'id']);
        return view('timetable.edit_timetable', compact('TimetableEdit', 'teachers'));
    }

    /** update record */
    public function TimetableUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            // convert dat int to string 
            $weekDays = Lesson::WEEK_DAYS;
            $convertedDay = $weekDays[$request->day];

            $updateRecord = [
                'event_name'   => $request->subject,
                'class'   => $request->class,
                'event_time'   => $request->time,
                'event_date'   => $convertedDay,
                'teacher_name'   => $request->teacher,
            ];
            Timetable::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update Timetable  :)', 'Error');
            return redirect()->back();
        }
    }

    /** Timetable delete */
    public function TimetableDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Timetable::destroy($request->id);
                DB::commit();
                Toastr::success('Timetable deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Timetable deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
    public function getSubjectsTeacher()
    {
        $subjects = Subject::pluck('name', 'id');
        $teacher = Teacher::pluck('full_name', 'id');
        return response()->json([
            'subjects' => $subjects,
            'teachers' => $teacher,
        ]);
    }

    public function getTeacherSubjects(string $teacherId)
    {
        $subjects = Teacher::where('id', $teacherId)->first()->subjects;
        return response()->json([
            'subjects' => ($subjects !== null && $subjects !== "") ? unserialize($subjects) : []
        ]);
    }
}
