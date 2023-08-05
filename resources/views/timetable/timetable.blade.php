@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Time Table</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Time Table</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Time Table</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ route('timetable/add/page') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($timetableData as $key => $list)
                                            <tr>
                                                <td hidden class="id">{{ $list->id }}</td>
                                                <td>PRE{{ $list->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a>{{ $list->teacher_name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $list->class }}</td>
                                                <td>{{ $list->event_name }}</td>
                                                <td>{{ date('g:i a', strtotime($list->event_time)) }}</td>
                                                <td>{{ date('g:i a', strtotime($list->event_time . ' +2 hours')) }}</td>
                                                <td>{{ date('l', strtotime($list->event_date)) }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ url('timetable/edit/' . $list->id) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-danger-light timetable_delete"
                                                            data-bs-toggle="modal" data-bs-target="#timetableModal">
                                                            <i class="feather-trash-2 me-1"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">General Time Table</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>8:00 AM - 10:00 AM</th>
                                            <th>11:00 AM - 1:00 PM</th>
                                            <th>12:00 PM - 2:00 PM</th>
                                            <!-- Add more time slot headings as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            $timeSlots = [
                                                '8:00 am' => '10:00 am',
                                                '11:00 am' => '1:00 pm',
                                                '2:00 pm' => '4:00 pm',
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="timetableModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('timetable/delete') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <input type="hidden" name="id" class="e_id" value="">
                            <h2>Sure you want to delete</h2>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click', '.timetable_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());

        });
    </script>
@endsection
@endsection
