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
                                        <h3 class="card-title">Lead Transfer Log </h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="lead_log" action="lead.leadlog" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Old Agent ID</th>
                                                    <th>New Agent ID</th>
                                                    <th>Transfered By</th>
                                                    <th>Transfered On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($data))
                                                    @php $i = 1; @endphp
                                                    @foreach ($data as $result)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $result->old_agent_id }}</td>
                                                            <td>{{ $result->new_agent_id }}</td>
                                                            <td>{{ $result->transfered_by }}</td>
                                                            <td>{{ $result->created_at }}</td>
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
            var table = $('#lead_log').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv'
                ],
                
            });
        });
    </script>
@endsection
