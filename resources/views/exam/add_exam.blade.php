@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Exam</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('exam/page') }}">Exam</a></li>
                            <li class="breadcrumb-item active">Add Exam</li>
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
                            <form action="{{ route('exam/add/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Exam Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <select id="subject" name="subject" class="form-control select">
                                                <option value="">Select subject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <select id="class" name="class" class="form-control select">
                                                <option value="">Select class</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="time" name="start_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="time" name="end_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Event Date</label>
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                url: '/get_subjects_classes',
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
                        
                        var classSelect = $('#class');
                        classSelect.empty();
                        classSelect.append('<option value="">Select class</option>');
                        $.each(data.classes, function(id, name) {
                            classSelect.append('<option value="' + name + '">' + name + '</option>');
                        });
                    }
                });
            });
            </script>
            @endsection
@endsection
