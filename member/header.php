<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header ">
        <!-- Left Section -->
        <div class="content-header-section">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- User Dropdown -->
            <div class="dropdown d-inline-block" role="group">
                <button type="button" class="btn btn-dual-secondary dropdown-toggle" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu min-width-200" aria-labelledby="page-header-user-dropdown">
                    <a class="dropdown-item" href="personal_details.php">
                        <i class="si si-user mr-5"></i> Profile
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                        <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                        <span class="badge badge-primary">0</span>
                    </a>
                    <a class="dropdown-item" href="javascript:void(0)">
                        <i class="si si-note mr-5"></i> Invoices
                    </a>
                    <a class="dropdown-item" href="logout.php?logout">
                        <i class="si si-logout mr-5"></i> Sign Out
                    </a>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Left Section -->
    </div>
    <!-- END Header Content -->
</header>
<!-- END Header -->