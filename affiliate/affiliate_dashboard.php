<?php include ("affiliate_session.php"); ?> 
<html lang="en" class="no-focus">
    <?php include_once 'affiliate_head.php'; ?>
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "affiliate_dashboard.php";
            include_once 'affiliate_left_sidebar_menu.php';
            ?>
            <?php include_once 'affiliate_header.php';?>
            <link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <div class="row">
                        <!-- Row #1 -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-fx-shadow text-left" href="javascript:void(0)">
                                <div class="block-content block-content-full text-right clearfix">
                                    <div class="float-left mt-10">
                                        <i class="fa fa-bitcoin fa-3x text-gray"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-light">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Token</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-fx-shadow text-left" href="javascript:void(0)">
                                <div class="block-content block-content-full text-right clearfix">
                                    <div class="float-left mt-10">
                                        <i class="si si-users fa-3x text-gray"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-light">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Sponsor</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-fx-shadow text-left" href="javascript:void(0)">
                                <div class="block-content block-content-full text-right clearfix">
                                    <div class="float-left mt-10">
                                        <i class="si si-bag fa-3x text-gray"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-light">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-fx-shadow text-left" href="javascript:void(0)">
                                <div class="block-content block-content-full text-right clearfix">
                                    <div class="float-left mt-10">
                                        <i class="si si-wallet fa-3x text-gray"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-light">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #1 -->
                    </div>

                    <div class="block content shadow">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">My Link</label>
                                    <input type="text" class="form-control" id="my_link" value="http://localhost/REDFOOTPRINT/affiliate_link.php?id=<?php echo $user_id; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Option</label>
                                    <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block" onclick="copy_link()">Copy link</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Table Full -->
                    <div class="block shadow">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">List of <small>Transaction</small></h3>
                        </div>
                        
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <style>.timer {color: #fff;border-radius: 50px;width: 100%;font-size: 12px;}thead{background-color: #2d3238b8;color: #fff;}</style>
                            <table class="table table-bordered table-striped table-vcenter table-hover js-dataTable-full">
                                <thead>
                                    <tr>
                                <?php 
                                    if($user_type == "Admin")
                                    {
                                        echo '<th class="d-none d-sm-table-cell">NAME</th>';
                                    }
                                ?>
                                        <th>TX No.</th>
                                        <th class="d-none d-sm-table-cell text-center">Date</th>
                                        <th class="d-none d-sm-table-cell text-center">Currency</th>
                                        <th class="d-none d-sm-table-cell text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php
                                        if($user_type == "Admin")
                                        {
                                            $results = mysqli_query($conn, "SELECT * FROM wp_transaction ORDER BY transaction_status DESC");
                                        }
                                        else
                                        {
                                            $results = mysqli_query($conn, "SELECT * FROM wp_transaction WHERE transaction_user_id='$user_id' ORDER BY transaction_status DESC");
                                        }                  
                                        while($rows = mysqli_fetch_array($results))
                                        {
                                            $member_id = $rows['transaction_user_id'];
                                            $select_member = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_id = '$member_id'");
                                            $fetch = mysqli_fetch_array($select_member);
                                            echo 
                                            '<tr style="cursor: pointer;" data-toggle="modal" data-target="#modal-normal" id="'.$rows['transaction_num'].'" onclick="click_transaction(this.id)">';
                                            if($user_type == "Admin")
                                            {
                                                echo '<td class="d-none d-sm-table-cell">'.$fetch['user_fname'][0].' '.$fetch['user_mname'].' '.$fetch['user_lname'].'</td>';
                                            } 
                                            echo'
                                              <td>'.$rows['transaction_num'].'</td>                                              
                                              <td class="d-none d-sm-table-cell text-center">'.$rows['transaction_date'].'</td>                                        
                                              <td class="d-none d-sm-table-cell text-center">'.$rows['transaction_currency'].'</td>
                                              <td class="d-none d-sm-table-cell text-right">'.$rows['transaction_amount'].'</td>      
                                              <td class="text-center">';                                                
                                                  if($rows['transaction_status'] == 'Pending')
                                                  {
                                                    echo '<span class="badge badge-warning">Pending</span>';
                                                  }
                                                  else if ($rows['transaction_status'] == 'Cancel' )
                                                  {
                                                    echo '<span class="badge badge-danger">Cancel</span>';
                                                  }
                                                  else if ($rows['transaction_status'] == 'Completed' )
                                                  {
                                                    echo '<span class="badge badge-success">Completed</span>';
                                                  }
                                                  else if ($rows['transaction_status'] == 'Unlock' )
                                                  {
                                                    echo '<span class="badge badge-primary">Unlock</span>';
                                                  }
                                                  else if ($rows['transaction_status'] == 'Paid' )
                                                  {
                                                    echo '<span class="badge badge-dark">Paid</span>';
                                                  }
                                                    echo '
                                              </td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->                         
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <?php include_once 'affiliate_footer.php';?>
        </div>
        <!-- END Page Container -->
        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script> 

        <script type="text/javascript">
            function copy_link()
            {
                var copyText = document.getElementById("my_link");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                alert('Link copied.');
            }
        </script>

        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>
        <script src="../assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <script src="../assets/js/pages/db_pop.min.js"></script>
        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_pages_crypto_dashboard.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_tables_datatables.min.js"></script>
    </body>
</html>