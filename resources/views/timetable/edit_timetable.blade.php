@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Time Table</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('timetable/page') }}">Time Table</a></li>
                            <li class="breadcrumb-item active">Edit Time Table</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('timetable/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Time Table</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Teacher Name <span class="login-danger">*</span></label>
                                            <select id="teacher" name="teacher" class="form-control select">
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><input type="hidden" name="id" value="{{ $TimetableEdit->id }}">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject <span class="login-danger">*</span></label>
                                            <select id="subject" name="subject" class="form-control select">
                                                <option value="">Select subject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="class">
                                                <option selected>{{ $TimetableEdit->class }}</option>
                                                <option>LKG</option>
                                                <option>UKG</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Day <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="day">
                                                <option selected>{{ $TimetableEdit->event_date }}</option>
                                                <option>Monday</option>
                                                <option>Tuesday</option>
                                                <option>Wednesday</option>
                                                <option>Thursday</option>
                                                <option>Friday</option>
                                                <option>Saturday</option>
                                                <option>Sunday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Start Time <span class="login-danger">*</span></label>
                                            <input type="time" value="{{ $TimetableEdit->event_time }}" name="time"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        function __getTeacherSubjects(teacherId) {
            $.ajax({
                url: '/get_teacher_subjects/' + teacherId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    var subjectSelect = $('#subject');
                    subjectSelect.empty();
                    subjectSelect.append('<option value="">Select subject</option>');
                    $.each(data.subjects, function(id, name) {
                        subjectSelect.append('<option value="' + name + '">' +
                            name +
                            '</option>');
                    });
                }
            });
        }

        __getTeacherSubjects($("#teacher").val())
        $(document).ready(function() {
            $("#teacher").change(function() {
                __getTeacherSubjects($(this).val());

            })
        });
    </script>
@endsection
@endsection
