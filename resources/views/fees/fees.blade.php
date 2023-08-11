@extends('layouts.master')
@section('content')

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Fees</li>
                        </ul>
                    </div>
                </div>
            </div>
            <style>
                /* Add this CSS to your existing styles or create a new CSS file */
                .code-set2,
                .code-set3 {
                    display: none;
                    /* Hide the code sets by default */
                    margin-top: 20px;
                }
            </style>

            {{-- message --}}
            {!! Toastr::message() !!}
            @php
                $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
                $userRole = Session::get('role_name');
            @endphp
            @if (in_array($userRole, $allowedRoles))
                @if ($userRole === 'Super Admin' || $userRole === 'Admin' || $userRole === 'Accounting')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">

                                    <div class="page-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="page-title">Fees</h3>
                                            </div>
                                            <div class="col-auto text-end float-end ms-auto download-grp">
                                                <a href="#" class="btn btn-outline-primary me-2"><i
                                                        class="fas fa-download"></i> Download</a>
                                                <a href="{{ route('fees/page/add') }}" class="btn btn-primary"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Fees Name</th>
                                                    <th>Class</th>
                                                    <th>Amount</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($feesList as $key => $list)
                                                    <tr>
                                                        <td hidden class="id">{{ $list->id }}</td>
                                                        <td>PRE{{ $list->id }}</td>
                                                        <td>
                                                            <h2>
                                                                <a>{{ $list->name }}</a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $list->class }}</td>
                                                        <td>${{ $list->amount }}</td>
                                                        <td class="text-end">
                                                            <div class="actions">
                                                                <a href="{{ url('fees/edit/' . $list->id) }}"
                                                                    class="btn btn-sm bg-danger-light">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <a class="btn btn-sm bg-danger-light fee_delete"
                                                                    data-bs-toggle="modal" data-bs-target="#feeModal">
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
                    @elseif($userRole === 'Student')
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Your School Fees</h5>
                                </div>
                                <form id="payForm">
                                    <div class="element-size-100">
                                        <div class="cs-team team-grid  table-responsive ">
                                            <table class="table table-bordered table-stripped" style="font-size:12px;">
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ Session::get('first_name') }} {{ Session::get('last_name') }}
                                                    </td>
                                                    <th>Admission Number:</th>
                                                    <td>{{ Session::get('admission_id') }}</td>
                                                    <th>Session:</th>
                                                    <td>2021/2022</td>
                                                </tr>
                                                <tr>
                                                    <th>Class:</th>
                                                    <td>{{ Session::get('class') }}</td>
                                                    <th>Phone Number:</th>
                                                    <td>{{ Session::get('phone_number') }}</td>
                                                    <th>Email:</th>
                                                    <td>{{ Session::get('email') }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Fees</th>
                                                            <th class="text-end">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $totalPrice = 0; // Initialize the variable to store the sum
                                                        @endphp
                                                        @foreach ($studentresult as $key => $list)
                                                            <tr>
                                                                <td>{{ ++$key }}</td>
                                                                <td>{{ $list->name }}</td>
                                                                <td class="text-end">&#8358;{{ $list->amount }}</td>
                                                            </tr>
                                                            @php
                                                                
                                                                $totalPrice += $list->amount; // Add the price of the current item to the total
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <th class="text-end">Total</th>
                                                            <th class="text-end">&#8358;{{ $totalPrice }}</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input type="hidden" id="name" value="{{ Session::get('name') }}">
                                            {{-- <input type="hidden" id="first-name" value="{{ Session::get('first_name') }}"> --}}
                                            {{-- <input type="hidden" id="last-name" value="{{ Session::get('first_name') }}"> --}}
                                            <input type="hidden" id="phone" value="{{ Session::get('phone_number') }}">
                                            <input type="hidden" id="email-address" value="{{ Session::get('email') }}">
                                            <input type="hidden" id="amount" value="{{ $totalPrice }}">
                                            <div class="row">
                                                <div class="col-4 col-sm-3"></div>
                                                <div class="col-4 col-sm-3"></div>
                                                <div class="mt-3 col-sm-6">
                                                    <select id="codeSelector" class="select form-control">
                                                        <option value="code1">Paystack</option>
                                                        <option value="code2">Flutterwave</option>
                                                        <option value="code3">Bank Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="code1"style="margin-top: 20px;"
                                                class="invoice-setting-btn code-set text-end">
                                                <button type="button" onclick="payWithPaystack()"  class="btn btn-primary-save-bg">Pay</button>
                                            </div>

                                            <div id="code2" class="invoice-setting-btn code-set text-end code-set2">
                                                <button type="button" onclick="payNow()" class="btn btn-primary-save-bg">Pay</button>
                                            </div>

                                            <div id="code3" class="invoice-setting-btn code-set text-end code-set2">
                                                <button type="button" class="btn btn-primary-save-bg">Pay</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </form>
                @endif
            @endif
        </div>

    </div>

    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="feeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fees/delete') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <input type="hidden" name="id" class="e_id" value="">
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
@section('script')
    {{-- delete js --}}
    <script src="{{ URL::to('assets/js/checkout.js') }}"></script>

    <script>
        $(document).on('click', '.fee_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());

        });
    </script>
    <!-- Add this JavaScript after including jQuery -->
    <script>
        $(document).ready(function() {
            $("#codeSelector").change(function() {
                var selectedCode = $(this).val();
                $(".code-set").hide(); // Hide all code sets
                $("#" + selectedCode).show(); // Show the selected code set
            });
        });
        
    </script>
@endsection

@endsection
