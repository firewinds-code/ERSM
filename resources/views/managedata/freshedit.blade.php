<form action="{{ route('managedata.update') }}" method="post" id="editUser" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <label>Client Data</label>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="id_edit" type="hidden" value="{{ $data->id }}" class="form-control"
                                    id="id_edit">
                                <label for="tel">Customer Number</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="contact_no" type="tel" class="form-control"
                                            value="{{ $data->contact_no }}" id="contact_no" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input name="alt_contact_no" type="tel" class="form-control"
                                            id="alt_contact_no" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input name="customer_name" type="name" class="form-control"
                                    value="{{ $data->customer_name }}" id="customer_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_id">Parent ID</label>
                                <input type="number" class="form-control" name="parent_id"
                                    value="{{ $data->parent_id }}" id="parent_id" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bill_to_party_name">Bill To Party Name</label>
                                <input name="bill_to_party_name" type="name" class="form-control"
                                    value="{{ $data->bill_to_party_name }}" id="bill_to_party_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number">VIN No.</label>
                                @foreach ($vin_nos as $vin)
                                    <input name="vin_no" type="text" class="form-control"
                                        value="{{ $vin['vin_no'] }}" readonly>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vin_count">VIN No. Count</label>
                                <input name="vin_count" type="text" class="form-control" value="{{ $vinCounts }}"
                                    id="vin_count" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="plant_code">Plant Code</label>
                                <input name="plant_code" type="text" class="form-control"
                                    value="{{ $data->plant_code }}" id="plant_code" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usage_category">Usage Category</label>
                                <input name="usage_category" type="text" class="form-control"
                                    value="{{ $data->usage_category }}" id="usage_category" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="device_type">Device Type</label>
                                <input name="device_type" type="text" class="form-control"
                                    value="{{ $data->device_type }}" id="device_type" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input name="region" type="text" class="form-control" value="{{ $data->region }}"
                                    id="region" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_category">Customer Category</label>
                                <input name="customer_category" type="text" class="form-control"
                                    value="{{ $data->customer_category }}" id="customer_category" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rspm">RSPM</label>
                                <input name="rspm" type="text" class="form-control" id="rspm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rspm_mobile">RSPM Mobile</label>
                                <input name="rspm_mobile" type="text" class="form-control" id="rspm_mobile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Agent Data</label>
                        </div>
                        <div class="col-md-6">
                            <ol class="breadcrumb float-right">
                                <button type="button"
                                    class="btn btn-block bg-gradient-primary text-white form-control"
                                    data-inline="true" onclick="call('{{ $data->contact_no }}')">
                                    <i class="fa fa-phone icon-white"></i> Click to Call
                                </button>

                            </ol>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tel">Customer New Number If Any</label>
                        <input name="new_contact_no" type="tel" class="form-control" id="new_contact_no">
                    </div>
                    <div class="form-group">
                        <label>Source Of Calling<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="source_of_calling"
                            id="source_of_calling">
                            <option value="">Select Source Of Calling</option>
                            {!! generateSourceOptions() !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Calling Status<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="calling_status"
                            id="calling_status">
                            <option value="">Select Calling Status</option>
                            {!! generateCallingOptions() !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Connect Status<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="connect_status"
                            id="connect_status">

                        </select>
                    </div>
                    <div class="form-group" id="callbackDiv">
                        <label>Call Back<span class="text-danger">*</span></label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#call_back"
                                name="call_back" id="call_back" />
                            <div class="input-group-append" data-target="#call_back" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="followupDiv">
                        <label>Follow Ups<span class="text-danger">*</span></label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="follow_ups"
                                id="follow_ups" data-target="#follow_ups" />
                            <div class="input-group-append" data-target="#follow_ups" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="quotation_div">
                        <label>No of Years Quotation Given</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="quotation"
                            id="quotation">
                            <option value="">Select No of Years Quotation Given</option>
                            {!! generateQuotationOptions() !!}
                        </select>
                    </div>
                    <div class="form-group" id="price_div">
                        <label for="price">Price Given</label>
                        <input name="price" type="number" class="form-control" id="price">
                    </div>

                    <div class="form-group">
                        <label for="remarks">Remarks<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="4" cols="50"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($data->status != 'Closed')
        <div align="center">
            <div class="card-footer">
                <button onclick="" name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    @endif
    <br>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <label>Call History</label>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Agent Tracking</h3>
                </div>
                <div class="card-body">
                    <table id="history" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Source Of calling</th>
                                <th>Calling Status</th>
                                <th>Connect Status</th>
                                <th>No. Of Years Quotation Given</th>
                                <th>Price Given</th>
                                <th>Call Back</th>
                                <th>Follow Ups</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($results))
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->source_of_calling }}</td>
                                        <td>{{ $result->calling_status }}</td>
                                        <td>{{ $result->connect_status }}</td>
                                        <td>{{ $result->year }}</td>
                                        <td>{{ $result->price }}</td>
                                        <td>{{ $result->call_back }}</td>
                                        <td>{{ $result->followup }}</td>
                                        <td>{{ $result->remarks }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('#editUser').validate({
            rules: {
                source_of_calling: {
                    required: true
                },
                calling_status: {
                    required: true
                },
                connect_status: {
                    required: true
                },
                remarks: {
                    required: true
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.select2bs4Edit').select2({
            theme: 'bootstrap4'
        })
        $('.select2bs4Create').select2({
            theme: 'bootstrap4'
        })
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        $('#timepicker').datetimepicker({
            format: 'LT'
        })
        $('#call_back').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
        $('#follow_ups').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
        $('#callbackDiv').hide();
        $('#followupDiv').hide();
        $('#calling_status').on('change', function() {
            var selectedCallingStatus = $(this).val();
            $.ajax({
                url: "{{ route('disposition') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    selectedCallingStatus: selectedCallingStatus,
                },
                success: function(response) {
                    $("#connect_status").empty();
                    $('#connect_status').append('<option value="' + '">' +
                        ' Select Connect Status ' + '</option>');
                    for (val in response) {
                        var newOption = $('<option value="' + response[val][
                                'connect_status'
                            ] +
                            '">' + response[val]['connect_status'] + '</option>');
                        $('#connect_status').append(newOption);
                    }
                },
            });
        });

        $('#connect_status').on('change', function() {
            var selectedConnectStatus = $(this).val();
            $('#callbackDiv').hide();
            $('#followupDiv').hide();
            if (selectedConnectStatus == 'Call Back') {
                $('#callbackDiv').show();
                $('#followupDiv').hide();
            } else if (selectedConnectStatus == 'Follow Up - Quotation Sent' ||
                selectedConnectStatus == 'Follow Up - Ready for Payment' || selectedConnectStatus ==
                'Follow Up - Ready for Renewal') {
                if (selectedConnectStatus) {
                    $('#callbackDiv').hide();
                    $('#followupDiv').show();
                } else {
                    $('#callbackDiv').hide();
                    $('#followupDiv').hide();
                }
            } else {
                var notarr = ['Not Interested - High Renewal Cost',
                    'Not Interested - Reason not Shared', 'Not Interested - Using third party',
                    'Not Interested - Sold vehicle', 'Not Interested - RPC Not Available',
                    'Not Interested - RTO issue', 'Not Interested - Service issue',
                    'Not Interested - Accident vehicle', 'Not Interested - GPS Issue',
                    'Not Interested - services issue from Dealer',
                    'Not Interested - Financial issue',
                    'Not Interested - Not interested-local area',
                    'Not Interested - Not Interested-Driver is owner',
                    'Not Interested - Customer want free subscription',
                    'Not Interested - Customer Not Aware of Service'
                ];
                if (notarr.includes(selectedConnectStatus)) {
                    $('#callbackDiv').hide();
                    $('#followupDiv').hide();
                    $('#quotation_div').hide();
                    $('#price_div').hide();
                } else {
                    $('#callbackDiv').hide();
                    $('#followupDiv').hide();
                    $('#quotation_div').show();
                    $('#price_div').show();
                }

            }

        });
    });
</script>
<script type="text/javascript">
    $(function() {
        var table = $('#history').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv'
            ],

        });
    });
</script>

<script>
    function call(mobile_no) {
        // alert(mobile_no);
        var data_id = "{{ $data->id }}";
        $.ajax({
            type: "get",
            url: "{{ route('call') }}",
            data: {
                "mobile_no": mobile_no,
                "data_id": data_id
            },
            success: function(response) {
                console.log(response.status);
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    };
</script>
