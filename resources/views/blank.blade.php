@extends('layouts.master')
@section('content')
    
@endsection
{{-- <table>
    <thead>
        <tr>
            <th></th>
            <th>8:00 AM - 10:00 AM</th>
            <th>9:00 AM - 11:00 AM</th>
            <th>12:00 PM - 2:00 PM</th>
            <!-- Add more time slot headings as needed -->
        </tr>
    </thead>
    <tbody>
        @php
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $timeSlots = [
                '8:00 am' => '10:00 am',
                '9:00 am' => '11:00 am',
                '12:00 PM' => '2:00 PM',
                // Add more time slots as needed
            ];
        @endphp

        @foreach ($daysOfWeek as $day)
            <tr>
                <td>{{ $day }}</td>
                @foreach ($timeSlots as $startTime => $endTime)
                    <td>{{ $timetable[$day][$startTime] ?? '' }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table> --}}