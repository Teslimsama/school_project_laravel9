@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Events</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Events</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto text-end float-end ms-auto">
                        <a href="add-events.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your HTML modal for updating events -->
            <div class="modal fade" id="updateEventModal" tabindex="-1" role="dialog"
                aria-labelledby="updateEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateEventModalLabel">Update Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="event-title">Title</label>
                                <input type="text" class="form-control event-title">
                            </div>
                            <div class="form-group">
                                <label for="event-start">Start Date</label>
                                <input type="date" class="form-control event-start">
                            </div>
                            <div class="form-group">
                                <label for="event-end">End Date</label>
                                <input type="date" class="form-control event-end">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary update-event-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @section('script')
        <!-- Your JavaScript code -->
        <script>
            $(document).ready(function() {
                var CalendarApp = function() {
                    this.$calendar = $("#calendar");
                };

                CalendarApp.prototype.init = function() {
                    this.$calendarObj = this.$calendar.fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay'
                        },
                        navLinks: true,
                        editable: true,
                        events: "{{ route('getevent') }}", // Replace "getevent" with your Laravel route for fetching events
                        @php
                            $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
                            $userRole = Session::get('role_name');
                        @endphp

                        @if (in_array($userRole, $allowedRoles))
                            @if ($userRole === 'Super Admin' || $userRole === 'Admin')
                                displayEventTime: false,
                                selectable: true,
                                selectHelper: true,
                                select: function(start, end, allDay) {
                                    var title = prompt('Event Title:');
                                    if (title) {
                                        var start = moment(start).format('YYYY-MM-DD');
                                        var end = moment(end).format('YYYY-MM-DD');
                                        $.ajax({
                                            url: "{{ route('createevent') }}", // Replace "createevent" with your Laravel route for creating events
                                            data: 'title=' + title + '&start=' + start +
                                                '&end=' + end +
                                                '&_token=' + "{{ csrf_token() }}",
                                            type: "post",
                                            success: function(data) {
                                                alert("Added Successfully");
                                                $('#calendar').fullCalendar(
                                                    'refetchEvents');
                                            }
                                        });
                                    }
                                },
                                eventClick: function(event) {
                                    var updateEventModal = $('#updateEventModal');
                                    updateEventModal.find('.event-title').val(event.title);
                                    updateEventModal.find('.event-start').val(moment(event.start)
                                        .format(
                                            'YYYY-MM-DD'));
                                    updateEventModal.find('.event-end').val(moment(event.end).format(
                                        'YYYY-MM-DD'));

                                    updateEventModal.find('.update-event-btn').on('click', function() {
                                        var title = updateEventModal.find('.event-title').val();
                                        var start = updateEventModal.find('.event-start').val();
                                        var end = updateEventModal.find('.event-end').val();

                                        // Perform AJAX request to update the event on the server
                                        $.ajax({
                                            url: "{{ route('updateevent') }}", // Replace with your Laravel route for updating events
                                            data: 'id=' + event.id + '&title=' + title +
                                                '&start=' + start + '&end=' + end +
                                                '&_token=' + "{{ csrf_token() }}",
                                            type: "post",
                                            success: function(data) {
                                                alert("Event Updated Successfully");
                                                $('#calendar').fullCalendar(
                                                    'refetchEvents');
                                                updateEventModal.modal('hide');
                                            }
                                        });
                                    });

                                    // Show the modal when an event is clicked
                                    updateEventModal.modal('show');
                                },

                                // Event Resize
                                eventResize: function(event, delta, revertFunc) {
                                    var newStart = moment(event.start).format('YYYY-MM-DD');
                                    var newEnd = moment(event.end).format('YYYY-MM-DD');

                                    // Perform AJAX request to update the event on the server
                                    $.ajax({
                                        url: "{{ route('updateevent') }}", // Replace with your Laravel route for updating events
                                        data: 'id=' + event.id + '&start=' + newStart +
                                            '&end=' +
                                            newEnd +
                                            '&_token=' + "{{ csrf_token() }}",
                                        type: "post",
                                        success: function(data) {
                                            alert("Event Resized Successfully");
                                            $('#calendar').fullCalendar('refetchEvents');
                                        },
                                        error: function() {
                                            alert(
                                                "Error: Could not resize event. Reverting changes."
                                            );
                                            revertFunc();
                                        }
                                    });
                                }
                            @endif
                        @endif
                    });
                };
                var calendarApp = new CalendarApp();
                calendarApp.init();
            });
        </script>
    @endsection
@endsection
