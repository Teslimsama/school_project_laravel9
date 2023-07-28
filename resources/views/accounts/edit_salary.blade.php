@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Salary</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('salary/page') }}">Accounts</a></li>
                            <li class="breadcrumb-item active">Edit Salary</li>
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
                            <form action="{{ route('salary/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Salary Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Staff ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" readonly>
                                            <input type="hidden" name="id" class="form-control" value="{{$salaryEdit->id}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input type="text" name="name" value="{{$salaryEdit->name}}"class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="status" id="exampleFormControlSelect1">
                                                <option>Select Status</option>
                                                <option>Paid</option>
                                                <option>Unpaid</option>
                                                <option>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date Paid<span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker"value="{{$salaryEdit->date}}" name="date_paid" type="text"
                                                placeholder="DD-MM-YYYY">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Amount <span class="login-danger">*</span></label>
                                            <input type="text" name="amount" value="{{$salaryEdit->amount}}" class="form-control">
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
@endsection
