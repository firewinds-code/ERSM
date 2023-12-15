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
                                        <h3 class="card-title">Lead Management </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-default">
                                                    <div class="card-body">
                                                        
                                                        <div class="row text-center">
                                                            <div class="col-md-1">
                                                                <a class="btn btn-app bg-olive" onclick="callTable('0')">
                                                                    <span class="badge bg-purple">
                                                                        @if (isset($freshcount))
                                                                            {{ $freshcount }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="fas fa-database"></i>Fresh Data
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a class="btn btn-app bg-warning" onclick="callTable('1')">
                                                                    <span class="badge bg-blue">
                                                                        @if (isset($followupcount))
                                                                            {{ $followupcount }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="far fa-clock"></i> Follow Up
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a class="btn btn-app bg-primary" onclick="callTable('2')">
                                                                    <span class="badge bg-danger">
                                                                        @if (isset($callbackcount))
                                                                            {{ $callbackcount }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="fas fa-envelope"></i> Call Back
                                                                </a>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a class="btn btn-app bg-danger" onclick="callTable('3')">
                                                                    <span class="badge bg-warning">
                                                                        @if (isset($notconnectedcount))
                                                                            {{ $notconnectedcount }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="fas fa-phone"></i> Not Connected
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a class="btn btn-app bg-olive" onclick="callTable('4');">
                                                                    <span class="badge bg-purple">
                                                                        @if (isset($closedcount))
                                                                            {{ $closedcount }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="fas fa-window-close"></i> Closed
                                                                </a>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a class="btn btn-app bg-success" onclick="callTable('5')">
                                                                    <span class="badge bg-blue">
                                                                        @if (isset($paymentdone))
                                                                            {{ $paymentdone }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="far fa-check-circle"></i> Payment Done
                                                                </a>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a class="btn btn-app bg-warning" onclick="callTable('6')">
                                                                    <span class="badge bg-danger">
                                                                        @if (isset($notinterested))
                                                                            {{ $notinterested }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="fas fa-envelope"></i> Not Interested
                                                                </a>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a class="btn btn-app bg-success" onclick="callTable('7')">
                                                                    <span class="badge bg-blue">
                                                                        @if (isset($readyforrenew))
                                                                            {{ $readyforrenew }}
                                                                        @endif
                                                                    </span>
                                                                    <i class="far fa-thumbs-up"></i> Ready For Renewal
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="tableData">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function callTable(id) {

            $.ajax({
                type: "get",
                url: "{{ route('gettabledata') }}",
                data: {
                    "id": id
                },
                success: function(data) {
                    console.log(data.url);
                    if (data.status) {
                        toastr.success(data.message);
                        $('#tableData').html(data.html);
                    } else {
                        toastr.error(data.message);
                        $('#tableData').html('');
                    }

                }
            });
        }
    </script>
@endsection
