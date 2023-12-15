@extends('include.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div>
                </div>
            </div>
            @if (Auth::user()->usertype == '1')
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
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="card card-default">
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-md-1">
                                                                    <a class="btn btn-app bg-olive"
                                                                        onclick="callTable('0')">
                                                                        <span class="badge bg-purple">
                                                                            {{ leadCount(0) }}
                                                                        </span>
                                                                        <i class="fas fa-database"></i>Fresh Data
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a class="btn btn-app bg-warning"
                                                                        onclick="callTable('1')">
                                                                        <span class="badge bg-blue">
                                                                            {{ leadCount(1) }}
                                                                        </span>
                                                                        <i class="far fa-clock"></i> Follow Up
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a class="btn btn-app bg-primary"
                                                                        onclick="callTable('2')">
                                                                        <span class="badge bg-danger">
                                                                            {{ leadCount(2) }}
                                                                        </span>
                                                                        <i class="fas fa-envelope"></i> Call Back
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-app bg-danger"
                                                                        onclick="callTable('3')">
                                                                        <span class="badge bg-warning">
                                                                            {{ leadCount(3) }}
                                                                        </span>
                                                                        <i class="fas fa-phone"></i> Not Connected
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a class="btn btn-app bg-olive"
                                                                        onclick="callTable('4');">
                                                                        <span class="badge bg-purple">
                                                                            {{ leadCount(4) }}
                                                                        </span>
                                                                        <i class="fas fa-window-close"></i> Closed
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-app bg-success"
                                                                        onclick="callTable('5')">
                                                                        <span class="badge bg-blue">
                                                                            {{ leadCount(5) }}
                                                                        </span>
                                                                        <i class="far fa-check-circle"></i> Payment Done
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-app bg-warning"
                                                                        onclick="callTable('6')">
                                                                        <span class="badge bg-danger">
                                                                            {{ leadCount(6) }}
                                                                        </span>
                                                                        <i class="fas fa-envelope"></i> Not Interested
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-app bg-success"
                                                                        onclick="callTable('7')">
                                                                        <span class="badge bg-blue">
                                                                            {{ leadCount(7) }}
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
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
