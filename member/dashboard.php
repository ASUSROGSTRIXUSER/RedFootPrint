<?php include ("session.php"); ?> 
<html lang="en" class="no-focus">
    <?php include_once 'head.php'; ?>
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "dashboard.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>
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
                                    <div class="font-size-h3 font-w600 text-primary-light">
                                        <?php 
                                            if($user_type == "Admin")
                                            {
                                                echo '0';
                                            }
                                            else
                                            {
                                                $user_id = $row['user_id']; 
                                                $select_token = mysqli_query($conn, "SELECT * FROM wp_usermeta WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'");
                                                $fetch_token = mysqli_fetch_array($select_token);
                                                if($fetch_token['meta_value'] == "")
                                                { echo '0'; } 
                                                else
                                                { echo $fetch_token['meta_value']; }   
                                            }
                                        ?> 
                                    </div>
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
                                    <div class="font-size-h3 font-w600 text-primary-light">
                                        <?php 
                                            if($user_type == "Admin")
                                            {
                                                echo '0';
                                            }
                                            else
                                            {
                                                $select_sponsor = mysqli_query($conn, "SELECT * FROM wp_sponsor WHERE sponsor_to='$user_id'");
                                                $count = mysqli_num_rows($select_sponsor);
                                                echo $count;
                                            }
                                        ?>
                                    </div>
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

            <?php 
                if($user_type == "Admin")
                { ?>
                    <!-- Normal Modal -->
                    <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="block block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">TX: <span id="tx_id"></span></h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content" id="display_transaction">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Normal Modal -->
                <?php 
                }?>
                    <!-- Coins -->
                    <!--
                    <div class="block block-fx-shadow">
                        <ul id="crypto-tabs" class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="#crypto-coins-btc">
                                    <span class="d-sm-none">BTC</span>
                                    <span class="d-none d-sm-inline">Bitcoin <span class="text-muted">$14000</span></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#crypto-coins-eth">
                                    <span class="d-sm-none">ETH</span>
                                    <span class="d-none d-sm-inline">Ethereum <span class="text-muted">$1100</span></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#crypto-coins-ltc">
                                    <span class="d-sm-none">LTC</span>
                                    <span class="d-none d-sm-inline">Litecoin <span class="text-muted">$250</span></span>
                                </a>
                            </li>
                            <li class="nav-item ml-auto">
                                <div class="block-options mr-15">
                                    <div class="dropdown" role="group">
                                        <button type="button" class="btn-block-option" id="btnGroupTabs1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-calendar mr-5"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupTabs1">
                                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary" tabindex="-1">1 Hour</button>
                                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary" tabindex="-1">1 Week</button>
                                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary active" tabindex="-1">1 Month</button>
                                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary" tabindex="-1">1 Year</button>
                                            <div class="dropdown-divider"></div>
                                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary" tabindex="-1">ALL</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="block-content block-content-full tab-content">
                            <div class="tab-pane" id="crypto-coins-btc">
                                <div class="row items-push text-center my-20">
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">$14.000</div>
                                        <div class="text-muted font-w600 text-uppercase">Bitcoin Price</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-success">+</span> $3.500
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (USD)</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-success">+</span> 133%
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (%)</div>
                                    </div>
                                </div>
                                <hr class="my-30">
                                <div>
                                    <canvas class="js-chartjs-bitcoin" height="300"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane" id="crypto-coins-eth">
                                <div class="row items-push text-center my-20">
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">$1.100</div>
                                        <div class="text-muted font-w600 text-uppercase">Ethereum Price</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-success">+</span> $600
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (USD)</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-success">+</span> 210%
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (%)</div>
                                    </div>
                                </div>
                                <hr class="my-30">
                                <div>
                                    <canvas class="js-chartjs-ethereum" height="300"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane" id="crypto-coins-ltc">
                                <div class="row items-push text-center my-20">
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">$250</div>
                                        <div class="text-muted font-w600 text-uppercase">Litecoin Price</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-danger">-</span> $50
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (USD)</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-h3 font-w700">
                                            <span class="text-danger">-</span> 17%
                                        </div>
                                        <div class="text-muted font-w600 text-uppercase">Since Last Month (%)</div>
                                    </div>
                                </div>
                                <hr class="my-30">
                                <div>
                                    <canvas class="js-chartjs-litecoin" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- END Coins -->

                    
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script> 

        <script type="text/javascript">
            function click_transaction(id)
            {              
                document.getElementById("tx_id").innerHTML = id;
                display_transaction();
            }
            function display_transaction()
            {
                tx_id = document.getElementById("tx_id").innerHTML;
                $.ajax({  
                    url:"ajax.php",  
                    method:"post",  
                    data:{
                        tx_id:tx_id,
                        display_transaction:1
                    },  
                    success:function(response){  
                        $('#display_transaction').html(response);  
                    }  
               });  
            }
            function approve_transaction(id)
            {
                member_id = id;
                tx_id = document.getElementById("tx_id").innerHTML;
                if(confirm("Are you sure you want to approve this transaction?"))
                {                    
                    $.ajax({  
                        url:"ajax.php",  
                        method:"post",  
                        data:{
                            member_id:member_id,
                            tx_id:tx_id,
                            approve_transaction: 1,
                        },  
                        success:function(data){  
                            alert('Transaction approved.');
                            location.reload();
                        }
                    }); 
                }
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