<body class="hold-transition sidebar-mini sidebar-collapse text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user mr-2"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="changepassword()" data-toggle="modal"
                            data-target="#changepassword">
                            <i class="fa fa-user-shield mr-2"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit(); "
                                class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <aside class="main-sidebar sidebar-dark-info  elevation-4">
                <div class="sidebar">
                    <div class="user-panel d-flex" style="background-color: white;height: 3rem; width: 20.2rem; margin-left: -0.5rem; ">
                        <!-- For Small Logo -->
                        <img src="https://hiring.cogentlab.com/ed/public/alldocs/images/logo_1.png" alt="AdminLTE Logo"
                            class="brand-image-xs logo-xs mt-0.1"
                            style="height: 2rem;width: 2.6rem;margin-left: -0.4rem;">
                        <!-- For Big Logo -->
                        <img src="https://ems.cogentlab.com/erpm/Style/images/Cogent.png" alt="AdminLTE Logo"
                            class="brand-image-xl logo-xl" style="height: 2rem;width: 9.5rem;margin-left: 2rem">
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                        @if (Auth::user()->usertype == '1')
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('manageuser.list') }}" class="nav-link ">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Manage User</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('uploaddata.excel') }}" class="nav-link">
                                        <i class="nav-icon fas fa-upload"></i>
                                        <p>Upload Data</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('agenttracking.list') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-circle"></i>
                                        <p>Agent Tracking</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('calllog') }}" class="nav-link">
                                        <i class="nav-icon fas fa-file-alt	"></i>
                                        <p>Click To Call Log</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('leadtransfer') }}" class="nav-link">
                                        <i class="nav-icon fas fa-exchange-alt"></i>
                                        <p>Lead Transfer</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('leadlog') }}" class="nav-link">
                                        <i class="nav-icon fas fa-file-export"></i>
                                        <p>Lead Data Transfer Log</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if (Auth::user()->usertype == '2')
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('managedata.list') }}" class="nav-link ">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Manage Data</p>
                                    </a>

                                </li>
                            </ul>
                        @endif
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('report') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Report</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit(); "
                                        class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Logout</p>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </form>
        <div class="modal fade" id="changepassword">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h4 class="modal-title">Change Password</h4>
                        <button type="button" style="color: #ffffff" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="card-body" id="changepasswordbody">
                    </div>
                </div>
            </div>
        </div>
        <script>
            function changepassword(id) {
                $.ajax({
                    type: "get",
                    url: "{{ route('changepassword') }}",
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        console.log(data.url);
                        $("#changepassword").modal('show');
                        $('#changepasswordbody').html(data.html);
                    }
                });
            };
        </script>
