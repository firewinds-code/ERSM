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
                                        <h3 class="card-title">Agent Tracking</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="manageAgent" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Agent Name</th>
                                                    <th>Fresh</th>
                                                    <th>Follow Up</th>
                                                    <th>Call Back</th>
                                                    <th>Not Connected</th>
                                                    <th>Closed</th>
                                                    <th>Payment Done</th>
                                                    <th>Not Interested</th>
                                                    <th>Ready For Renewal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($flagCounts))
                                                    @foreach ($flagCounts as $result)
                                                        <tr>
                                                            <td>{{ $result->name }}</td>
                                                            <td>{{ $result->{'flag 0'} }}</td>
                                                            <td>{{ $result->{'flag 1'} }}</td>
                                                            <td>{{ $result->{'flag 2'} }}</td>
                                                            <td>{{ $result->{'flag 3'} }}</td>
                                                            <td>{{ $result->{'flag 4'} }}</td>
                                                            <td>{{ $result->{'flag 5'} }}</td>
                                                            <td>{{ $result->{'flag 6'} }}</td>
                                                            <td>{{ $result->{'flag 7'} }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
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
            var table = $('#manageAgent').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv'
                ],
            });
        });
    </script>

@endsection
