<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Management </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="manageData" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>S.No.</th>
                                    <th>VIN No.</th>
                                    <th>Customer Name</th>
                                    <th>Contact Number</th>
                                    <th>Usage Category</th>

                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">

                                @if (!empty($results))

                                    @php $i = 1; @endphp
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>
                                                <a onclick="editUser('{{ $result['id'] }}')" href="#"
                                                    class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal"><i class="fa fa-eye"
                                                        style="padding: 2px"></i></a>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td>{{ $result['vin_no'] }}</td>
                                            <td>{{ $result['customer_name'] }}</td>
                                            <td>{{ $result['contact_no'] }}</td>
                                            <td>{{ $result['usage_category'] }}</td>
                                        </tr>
                                        @php $i++; @endphp
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

<div id="editModal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Enter Data Details Here:-</h4>
                <button type="button" style="color: #ffffff" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
            </div>
            <div class="card-body" id="editbody">
            </div>
        </div>
    </div>
</div>

<script>
    function editUser(id) {
        $.ajax({
            type: "get",
            url: "{{ route('managedata.edit') }}",
            data: {
                "id": id
            },
            success: function(data) {
                console.log(data.html);
                if (data.status) {
                    $('#editModal').modal({backdrop: 'static', keyboard: false}, 'show');
                    $('#editbody').html(data.html);
                } else {
                    toastr.error(data.html);
                }

            }
        });
    };
</script>

<script type="text/javascript">
    $(function() {
        var table = $('#manageData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv'
            ],
        });
    });
</script>
