@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Salary</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('salary/page') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Salary</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ route('salary/add/page') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Date Paid</th>
                                            <th>Amount</th>
                                            <th class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salaryList as $key => $list)
                                            <tr>
                                                <td>PRE{{ $list->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('salary/edit/' . $list->id) }}">{{ $list->name }}
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>{{ $list->date }}</td>
                                                <td>${{ $list->amount }}</td>
                                                <td class="text-end">
                                                    <span class="payment-status toggle-button badge badge-{{status($list->status)}}" data-id="{{ $list->id}}">{{ $list->status }}</span>
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
        </div>

    </div>
    @section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click', '.student_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.e_avatar').val(_this.find('.avatar').text());
        });
    </script>
   
<script>
    // Function to update the data with AJAX
    function updateData(id, newValue) {
        $.ajax({
            url: "{{ route('salary/update-data', ':id') }}".replace(':id', id),
            type: "put",
            data: {
                new_value: newValue,
                _token:"{{ csrf_token() }}"
            },
            success: function (response) {
                // Handle the response, if needed
                console.log('Data updated successfully.');
                location.reload();
            },
            error: function (error) {
                // Handle the error, if any
                console.error('Failed to update data.');
            }
        });
    }

    // Function to toggle the value between 'Paid', 'Unpaid', and 'Pending'
    function toggleValue(element) {
        var values = ['Paid', 'Unpaid', 'Pending'];
        var currentVal = element.text().trim();
        var nextVal = values[(values.indexOf(currentVal) + 1) % values.length];
        element.text(nextVal);
        // Update the database with the new value using AJAX
        var dataId = element.data('id');
        updateData(dataId, nextVal);
    }

    // Example: Toggle the value when a button is clicked
    $('.toggle-button').click(function() {
        toggleValue($(this));
    });
</script>
@endsection
