@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Expenses</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('expenses/page') }}">Accounts</a></li>
                            <li class="breadcrumb-item active">Edit Expenses</li>
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
                            <form action="{{ route('expenses/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Expense Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Item Name <span class="login-danger">*</span></label>
                                            <input type="text" name="item_name" value="{{$expensesEdit->item_name}}" class="form-control">
                                        </div>
                                            <input type="hidden" class="form-control" name="id" value="{{$expensesEdit->id}}" readonly>

                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Item Quantity <span class="login-danger">*</span></label>
                                            <input type="text" name="item_quantity"value="{{$expensesEdit->item_quantity}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Expense Amount <span class="login-danger">*</span></label>
                                            <input type="text" name="amount"value="{{$expensesEdit->amount}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Source of Purchase <span class="login-danger">*</span></label>
                                            <input type="text" name="purchase_source" value="{{$expensesEdit->purchase_source}}"class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Purchase Date<span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker"
                                                name="purchase_date" type="text"value="{{$expensesEdit->purchase_date}}" placeholder="DD-MM-YYYY">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Purchase By <span class="login-danger">*</span></label>
                                            <input type="text" name="purchase_by" value="{{$expensesEdit->purchase_by}}"class="form-control">
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
