@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Subjects</li>
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
                    <div class="subject-group-form">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-10 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search by Name ...">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="search-student-btn">
                                        <button type="btn" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="page-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="page-title">Subjects</h3>
                                            </div>
                                            <div class="col-auto text-end float-end ms-auto download-grp">
                                                <a href="#" class="btn btn-outline-primary me-2"><i
                                                        class="fas fa-download"></i> Download</a>
                                                <a href="{{ route('subject/add/page') }}" class="btn btn-primary"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-subject table-hover table-center mb-0 datatable table-striped">
                                            <thead class="subject-thread">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Class</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subjectList as $key => $list)
                                                    <tr>
                                                        <td hidden class="id">{{ $list->id }}</td>
                                                        <td>PRE{{ $list->id }}</td>
                                                        <td>
                                                            <h2>
                                                                <a>{{ $list->name }}</a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $list->class }}</td>
                                                        <td class="text-end">
                                                            <div class="actions">
                                                                <a href="{{ url('subject/edit/' . $list->id) }}"
                                                                    class="btn btn-sm bg-danger-light">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <a class="btn btn-sm bg-danger-light subject_delete"
                                                                    data-bs-toggle="modal" data-bs-target="#subjectModal">
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
                    {{-- teeachers view --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Bordered Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subjects</th>
                                                    <th>Class</th>
                                                    <th>Time</th>
                                                    <th>Days</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John</td>
                                                    <td>Doe</td>
                                                    <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="711b1e191f311409101c011d145f121e1c">[email&#160;protected]</a>
                                                    </td>
                                                    <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="711b1e191f311409101c011d145f121e1c">[email&#160;protected]</a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @elseif ($userRole === 'Student')
                    {{-- students view --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Bordered Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subjects</th>
                                                    <th>Class</th>
                                                    <th>Time</th>
                                                    <th>Days</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John</td>
                                                    <td>Doe</td>
                                                    <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="711b1e191f311409101c011d145f121e1c">[email&#160;protected]</a>
                                                    </td>
                                                    <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="711b1e191f311409101c011d145f121e1c">[email&#160;protected]</a>
                                                    </td>
                                                </tr>

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
        {{-- model subject delete --}}
        <div class="modal fade contentmodal" id="subjectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content doctor-profile">
                    <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="feather-x-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('subject/delete') }}" method="POST">
                            @csrf
                            <div class="delete-wrap text-center">
                                <div class="del-icon">
                                    <i class="feather-x-circle"></i>
                                </div>
                                <input type="hidden" name="id" class="e_id" value="">
                                {{-- <input type="hidden" name="avatar" class="e_avatar" value=""> --}}
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
    </div>

@section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click', '.subject_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            // $('.e_avatar').val(_this.find('.avatar').text());
        });
    </script>
@endsection
@endsection
