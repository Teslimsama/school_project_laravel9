@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('fees/page') }}">Fees</a></li>
                            <li class="breadcrumb-item active">Edit Fees</li>
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
                            <form action="{{ route('fees/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Fees Information</span></h5>
                                    </div>
                                    <input type="hidden" class="form-control" name="id" value="{{ $feesEdit->id }}"
                                        readonly>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Fees ID</label>
                                            <input type="text" class="form-control" value="{{ $feesEdit->id }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Fees Name</label>
                                            <input type="text" name="name"value="{{ $feesEdit->name }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Class</label>
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
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Fees Amount</label>
                                            <input type="text" name="amount"value="{{ $feesEdit->amount }}"
                                                class="form-control">
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
@endsection
