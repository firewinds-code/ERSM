@extends('include.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Upload Excel </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('uploaddata.import') }}" method="post" id="excel"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input name="file" type="file" class="form-control"
                                                            id="file" placeholder="Upload File">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <button onclick="" name="submit" type="submit"
                                                            class="btn btn-primary toastrDefaultSuccess">Upload
                                                            File</button>

                                                    </div>
                                                </div>

                                                <div class="col-md-4 " id="format">
                                                    <a href="{{ url('table-export/?name=client_data') }}">
                                                        <i class="fa fa-download" style='color: black'
                                                            aria-hidden="true"></i>
                                                        Download Format</a>
                                                </div>
                                            </div>
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

    <script>
        $(function() {
            $('#excel').validate({
                rules: {
                    file: {
                        required: true,
                        extension: "csv",
                    },
                },
                messages: {
                    file: {
                        extension: "Please select a valid CSV file.",
                    }
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
        });
    </script>
@endsection
