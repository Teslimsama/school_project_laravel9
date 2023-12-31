@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Exam</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Exam</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            @php
                $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
                $userRole = Session::get('role_name');
            @endphp
            @if (in_array($userRole, $allowedRoles))
                @if ($userRole === 'Super Admin' || $userRole === 'Admin')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">

                                    <div class="page-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="page-title">Exam</h3>
                                            </div>
                                            <div class="col-auto text-end float-end ms-auto download-grp">
                                                <a href="#" class="btn btn-outline-primary me-2"><i
                                                        class="fas fa-download"></i> Download</a>
                                                <a href="{{ route('exam/add/page') }}" class="btn btn-primary"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Class</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Date</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($examList as $key => $list)
                                                    <tr>
                                                        <td hidden class="id">{{ $list->id }}</td>
                                                        <td>
                                                            <h2>
                                                                <a>{{ $list->subject }}</a>
                                                            </h2>
                                                        </td>
                                                        @php
                                                            $datetime = $list->start_time;
                                                            $datetime_2 = $list->end_time;
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime);
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime_2);
                                                            $startTime = $carbonInstance->format('h:i A');
                                                            $endTime = $carbonInstance->format('h:i A');
                                                        @endphp

                                                        <td>{{ $list->class }}</td>
                                                        <td>{{ $startTime }}</td>
                                                        <td>{{ $endTime }}</td>
                                                        <td>{{ $list->date }}</td>
                                                        <td class="text-end">
                                                            <div class="actions">
                                                                <a href="{{ url('exam/edit/' . $list->id) }}"
                                                                    class="btn btn-sm bg-danger-light">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <a class="btn btn-sm bg-danger-light exam_delete"
                                                                    data-bs-toggle="modal" data-bs-target="#examModal">
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
                    </div>
                    @elseif ($userRole === 'Teachers')
                    {{-- teeachers and student view --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Your Exams</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subjects</th>
                                                    <th>Class</th>
                                                    <th>Time</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($examList as $key => $list)
                                                    <tr>
                                                        <td>{{ $list->subject }}</td>
                                                        <td>{{ $list->class }}</td>
                                                         @php
                                                            $datetime = $list->start_time;
                                                            $datetime_2 = $list->end_time;
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime);
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime_2);
                                                            $startTime = $carbonInstance->format('h:i A');
                                                            $endTime = $carbonInstance->format('h:i A');
                                                        @endphp
                                                        <td>{{ $startTime }} - {{ $endTime }}</td>
                                                        <td>{{ $list->date }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @elseif ($userRole === 'Student')
                    {{-- student view --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Your Exams</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subjects</th>
                                                    <th>Class</th>
                                                    <th>Time</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentresult as $key => $list)
                                                    <tr>
                                                        <td>{{ $list->subject }}</td>
                                                        <td>{{ $list->class }}</td>
                                                         @php
                                                            $datetime = $list->start_time;
                                                            $datetime_2 = $list->end_time;
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime);
                                                            $carbonInstance = \Carbon\Carbon::parse($datetime_2);
                                                            $startTime = $carbonInstance->format('h:i A');
                                                            $endTime = $carbonInstance->format('h:i A');
                                                        @endphp
                                                        <td>{{ $startTime }} - {{ $endTime }}</td>
                                                        <td>{{ $list->date }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

            @endif
        </div>

    </div>
    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="examModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exam/delete') }}" method="POST">
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
        $(document).on('click', '.exam_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());

        });
    </script>
@endsection
@endsection
