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
                                        <h3 class="card-title">Click To Call Log </h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="call_log" action="report.calllog" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Vin No.</th>
                                                    <th>Parent ID</th>
                                                    <th>PRI Number</th>
                                                    <th>Mobile No.</th>
                                                    <th>Created_At</th>
                                                    <th>URL</th>
                                                    <th>Response</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($data))
                                                    @php $i = 1; @endphp
                                                    @foreach ($data as $result)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $result->vin_no }}</td>
                                                            <td>{{ $result->parent_id }}</td>
                                                            <td>{{ $result->pri_no }}</td>
                                                            <td>{{ $result->mobile }}</td>
                                                            <td>{{ $result->created_at }}</td>
                                                            <td>{{ $result->req_url }}</td>
                                                            <td>{{ $result->response }}</td>
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
            var table = $('#call_log').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv'
                ],                                                                               
            });
        });
    </script>
@endsection