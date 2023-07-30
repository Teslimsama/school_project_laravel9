@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Books</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('library/page') }}">Library</a></li>
                            <li class="breadcrumb-item active">Edit Books</li>
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
                            <form action="{{ route('library/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Book Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Book ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control"value="{{$libraryEdit->id}}" readonly>
                                            
                                            <input type="hidden" name="id" class="form-control" value="{{$libraryEdit->id}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Book Name <span class="login-danger">*</span></label>
                                            <input type="text" name="book_name" value="{{$libraryEdit->book_name}}"class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Language <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="language">
                                                <option>Select Language</option>
                                                <option>English</option>
                                                <option>Turkish</option>
                                                <option>Chinese</option>
                                                <option>Spanish</option>
                                                <option>Arabic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Department <span class="login-danger">*</span></label>
                                            <input type="text" name="department" value="{{$libraryEdit->department}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class</label>
                                            <select class="form-control select" name="class">
                                                <option>Select Class <span class="login-danger">*</span></option>
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
                                            <label>Type <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="type">
                                                <option>Select Type</option>
                                                <option>Book</option>
                                                <option>DVD</option>
                                                <option>CD</option>
                                                <option>Newspaper</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="status">
                                                <option>Select Status</option>
                                                <option>In Stock</option>
                                                <option>Out of Stock</option>
                                            </select>
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
