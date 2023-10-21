@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Teachers</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('teacher/list/page') }}">Teachers</a></li>
                            <li class="breadcrumb-item active">Add Teachers</li>
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
                            <form action="{{ route('teacher/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Basic Details</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('full_name') is-invalid @enderror"
                                                name="full_name" placeholder="Enter Name" value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('gender') is-invalid @enderror"
                                                name="gender">
                                                <option selected disabled>Select Gender</option>
                                                <option value="Female"
                                                    {{ old('gender') == 'Female' ? 'selected' : 'Female' }}>Female</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="Others" {{ old('gender') == 'Others' ? 'selected' : '' }}>
                                                    Others</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror"
                                                name="date_of_birth" placeholder="DD-MM-YYYY"
                                                value="{{ old('date_of_birth') }}">
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                                name="mobile" placeholder="Enter Phone" value="{{ old('mobile') }}">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Joining Date <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control datetimepicker @error('joining_date') is-invalid @enderror"
                                                name="joining_date" placeholder="DD-MM-YYYY"
                                                value="{{ old('joining_date') }}">
                                            @error('joining_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 local-forms">
                                        <div class="form-group">
                                            <label>Qualification <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('qualification') is-invalid @enderror"
                                                name="qualification" placeholder="Enter Joining Date"
                                                value="{{ old('qualification') }}">
                                            @error('qualification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Experience <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('experience') is-invalid @enderror"
                                                name="experience" placeholder="Enter Experience"
                                                value="{{ old('experience') }}">
                                            @error('experience')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Login Details</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Username <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" name="username"
                                                placeholder="Enter Username" value="{{ old('username') }}">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email ID <span class="login-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="Enter Mail Id" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password <span class="login-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter Password"
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Repeat Password <span class="login-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" placeholder="Repeat Password"
                                                value="{{ old('password_confirmation') }}">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Address</span></h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" placeholder="Enter address" value="{{ old('address') }}">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>City <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('city') is-invalid @enderror" name="city"
                                                placeholder="Enter City" value="{{ old('city') }}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>State <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('state') is-invalid @enderror" name="state"
                                                placeholder="Enter State" value="{{ old('state') }}">
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Zip Code <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('zip_code') is-invalid @enderror"
                                                name="zip_code" placeholder="Enter Zip" value="{{ old('zip_code') }}">
                                            @error('zip_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Country <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('country') is-invalid @enderror"
                                                name="country" placeholder="Enter Country" value="{{ old('country') }}">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="subjects" value="">

                                    <div class="col-12">
                                        <h5 class="form-title"><span>Subjects</span></h5>
                                    </div>
                                    <div class="col-12">

                                        <span class='selected_subjects'>Selected Subjects </span>
                                        <div class="form-group local-forms">
                                            <label>Subjects <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('gender') is-invalid @enderror"
                                                name="subject">
                                                <option selected disabled>Select Subject</option>

                                                @php
                                                    $subjects = App\Models\Teacher::subjects();
                                                @endphp
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->name }}"
                                                        data-name="{{ $subject->name }}">{{ $subject->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('subjects')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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

    <script>
        $(document).ready(function() {
            let __hiddenSubject = $("input[name=subjects]");

            $("select[name=subject]").change(function() {
                let __that = $(this);

                let __subjectName = __that.val();

                let __combinedValues = __hiddenSubject.val();

                let __splitedValuyes = __combinedValues.split(", ");
                let __filteredArrayValues = __splitedValuyes.filter((e) => {
                    if (e === __subjectName) {
                        return e;
                    }
                });

                if (__filteredArrayValues.length < 1) {

                    if (__hiddenSubject.val() !== "") {
                        __combinedValues = `${__combinedValues}, ${__subjectName}`;
                    } else {

                        __combinedValues = __subjectName;
                    }

                    __hiddenSubject.val(`${__combinedValues}`);

                    $(".selected_subjects").text(__combinedValues);
                }

                // console.log(__hiddenSubject.val());


            });
        });
    </script>
@endsection
