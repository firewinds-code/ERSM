@extends('include.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="container-fluid">
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Lead Transfer</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('leadupdate') }}" method="post" id="editUser" enctype="multipart/form-data">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-default">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Agent List<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2bs4"
                                                                        style="width: 100%;" name="old_agent"
                                                                        id="old_agent">
                                                                        <option value="">Select Agent</option>
                                                                        @foreach ($agents as $agent)
                                                                            <option value="{{ $agent->empID }}">
                                                                                {{ $agent->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Agent List<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control select2bs4"
                                                                        style="width: 100%;" name="new_agent"
                                                                        id="new_agent">
                                                                        <option value="">Select Agent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div align="center">
                                            <div class="card-footer">
                                                <button onclick="" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#old_agent').on('change', function() {
                var selectedOldAgentId = $(this).val();
                $.ajax({
                    url: "{{ route('getNewAgents') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        selectedOldAgentId: selectedOldAgentId,
                    },
                    success: function(data) {
                        var $newAgentDropdown = $('#new_agent');

                        $newAgentDropdown.empty();

                        $newAgentDropdown.append('<option value="">Select Agent</option>');
                        for (var i = 0; i < data.length; i++) {
                            $newAgentDropdown.append('<option value="' + data[i].empID + '">' +
                                data[i].name + '</option>');
                        }
                    },
                    error: function() {
                        console.log('Error fetching data for new_agent dropdown');
                    }
                });

            });
        });
    </script>
@endsection
