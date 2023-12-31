@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Subject</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('subject/list/page') }}">Subject</a></li>
                            <li class="breadcrumb-item active">Add Subject</li>
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
                            <form action="{{ route('subject/add/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Subject Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Botony">
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
            // Fetch departments and classes on page load
            $.ajax({
                url: '/getdepartment',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var departmentSelect = $('#department');
                    departmentSelect.empty();
                    departmentSelect.append('<option value="">Select department</option>');
                    $.each(data.department, function(id, name) {
                        departmentSelect.append('<option value="' + name + '">' + name +
                            '</option>');
                    });

                    var teacherSelect = $('#teacher');
                    teacherSelect.empty();
                    teacherSelect.append('<option value="">Select teacher</option>');
                    $.each(data.teacher, function(id, name) {
                        teacherSelect.append('<option value="' + id + '">' + name +
                        '</option>');
                    });
                }
            });
        });
    </script>
@endsection
@endsection
