@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Time Table</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('timetable/page') }}">Time Table</a></li>
                            <li class="breadcrumb-item active">Add Time Table</li>
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
                            <form action="{{ route('timetable/add/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Time Table</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Teacher Name <span class="login-danger">*</span></label>
                                            <select id="teacher" name="teacher" class="form-control select">
                                                <option value="">Select Teacher</option>
                                            </select>
                                        </div>
                                    </div>
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
                                                <option>Select Class</option>
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
                                                <option>Select Day</option>
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
                                            <input type="time" name="time" class="form-control">
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
        $(document).ready(function() {
            // Fetch subjects and classes on page load
            $.ajax({
                url: '/get_subjects_teacher',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var subjectSelect = $('#subject');
                    subjectSelect.empty();
                    subjectSelect.append('<option value="">Select subject</option>');
                    $.each(data.subjects, function(id, name) {
                        subjectSelect.append('<option value="' + name + '">' + name +
                            '</option>');
                    });

                    var teacherSelect = $('#teacher');
                    teacherSelect.empty();
                    teacherSelect.append('<option value="">Select teacher</option>');
                    $.each(data.teachers, function(id, name) {
                        teacherSelect.append('<option value="' + name + '">' + name +
                            '</option>');
                    });
                }
            });
        });
    </script>
@endsection
@endsection
