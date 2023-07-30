@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Library</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Library</li>
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
                                        <h3 class="page-title">Library</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ route('library/add/page') }}" class="btn btn-primary"><i
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
                                            <th>Name</th>
                                            <th>Language</th>
                                            <th>Department</th>
                                            <th>Class</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($libraryList as $key => $list)
                                            <tr>
                                                <td hidden class="id">{{ $list->id }}</td>
                                                <td>PRE{{ $list->id }}</td>
                                                <td>
                                                    <h2>
                                                        <a>{{ $list->book_name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $list->language }}</td>
                                                <td>{{ $list->department }}</td>
                                                <td>{{ $list->class }}</td>
                                                <td>{{ $list->type }}</td>
                                                <td>
                                                    <span
                                                        class="payment-status toggle-button badge badge-{{ librarystatus($list->status) }}"
                                                        data-id="{{ $list->id }}">{{ $list->status }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ url('library/edit/' . $list->id) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-danger-light library_delete"
                                                            data-bs-toggle="modal" data-bs-target="#libraryModal">
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
        </div>

    </div>
    {{-- model student delete --}}
    <div class="modal fade contentmodal" id="libraryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('library/delete') }}" method="POST">
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
    <script>
        $(document).on('click', '.library_delete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());

        });

        function updateData(id, newValue) {
            $.ajax({
                url: "{{ route('library/update-data', ':id') }}".replace(':id', id),
                type: "put",
                data: {
                    new_value: newValue,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Handle the response, if needed
                    console.log('Data updated successfully.');
                    location.reload();
                },
                error: function(error) {
                    // Handle the error, if any
                    console.error('Failed to update data.');
                }
            });
        }

        // Function to toggle the value between 'In Stock'and'Out Stock'
        function toggleValue(element) {
            var values = ['In Stock','Out Stock'];
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
@endsection
