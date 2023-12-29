@extends('include.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="container-fluid">
                        <br>
                        <form action="{{ route('daterange') }}" method="POST" id="daterange">
                            @csrf
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Date range:</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-left:20px;">
                                                    <label>Date range button:</label>
                                                    <input name="dateRangehid" type="hidden" id="dateRangehid">
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-default float-right"
                                                            id="reportrange">
                                                            <i class="far fa-calendar-alt"></i> <span></span>
                                                            <i class="fas fa-caret-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 ">
                                                <br>
                                                <div class="form-group">
                                                    <button onclick="" name="search" type="submit"
                                                        class="btn btn-primary mt-2">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Datatable </h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="reportwork" action="report.report" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Agent Name</th>
                                                    <th>VIN No</th>
                                                    <th>Parent ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Contact No</th>
                                                    <th>Alternate No</th>
                                                    <th>Calling No</th>
                                                    <th>Usage Category</th>
                                                    <th>Plant Code</th>
                                                    <th>Dealer Name</th>
                                                    <th>Dealer State</th>
                                                    <th>Bill To Party Name</th>
                                                    <th>Device type</th>
                                                    <th>Region</th>
                                                    <th>Customer Category</th>
                                                    <th>Call Back</th>
                                                    <th>Follow Up</th>
                                                    <th>Status</th>
                                                    <th>Source Of Calling</th>
                                                    <th>Calling Status</th>
                                                    <th>Connect Status</th>
                                                    <th>Years</th>
                                                    <th>Price</th>
                                                    <th>Remarks</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($data))
                                                    @php $i = 1; @endphp
                                                    @foreach ($data as $result)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $result->name }}</td>
                                                            <td>{{ $result->vin_no }}</td>
                                                            <td>{{ $result->parent_id }}</td>
                                                            <td>{{ $result->customer_name }}</td>
                                                            <td>{{ $result->contact_no }}</td>
                                                            <td>{{ $result->alternate_no }}</td>
                                                            <td>{{ $result->calling_no }}</td>
                                                            <td>{{ $result->usage_category }}</td>
                                                            <td>{{ $result->plant_code }}</td>
                                                            <td>{{ $result->dealer_name }}</td>
                                                            <td>{{ $result->dealer_state }}</td>
                                                            <td>{{ $result->bill_to_party_name }}</td>
                                                            <td>{{ $result->device_type }}</td>
                                                            <td>{{ $result->region }}</td>
                                                            <td>{{ $result->customer_category }}</td>
                                                            <td>{{ $result->call_back }}</td>
                                                            <td>{{ $result->followup }}</td>
                                                            <td>{{ $result->status }}</td>
                                                            <td>{{ $result->source_of_calling }}</td>
                                                            <td>{{ $result->calling_status }}</td>
                                                            <td>{{ $result->connect_status }}</td>
                                                            <td>{{ $result->year }}</td>
                                                            <td>{{ $result->price }}</td>
                                                            <td>{{ $result->remarks }}</td>
                                                            <td>{{ $result->created_at }}</td>
                                                            <td>{{ $result->updated_at }}</td>
                                                        </tr>
                                                        @php $i++; @endphp
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            var start = moment().subtract(0, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#dateRangehid').val(start.format('YYYY-MM-DD') + '@' + end.format('YYYY-MM-DD'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
    </script>
    <script>
        $(function() {
            $("#reportwork").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["csv"],
                "scrollX": true // Add this option for side-scrolling
            }).buttons().container().appendTo('#reportwork_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
