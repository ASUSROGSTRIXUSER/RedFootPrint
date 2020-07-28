<?php include ("session.php"); ?> 
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "sponsor.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                <?php
                if($user_type == "Member")
                {?>
                    <div class="block content shadow">
                        <!-- Personal Details -->      
                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            <span id="id_contact" class="badge float-right mt-5" style="font-size: 13px; color: #fff; background-color: #e74c3c;">User ID: <?php echo $row['user_id']; ?></span>
                            Personal details
                        </h2>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">User ID</label>
                                    <input type="text" class="form-control" id="crypto-settings-street-1" id="user_id" value="<?php echo $row['user_id'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">First Name</label>
                                    <input type="text" class="form-control" id="crypto-settings-street-1" value="<?php echo $row['user_fname'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Middle Name</label>
                                    <input type="text" class="form-control" id="crypto-settings-street-1" value="<?php echo $row['user_mname'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Last Name</label>
                                    <input type="text" class="form-control" id="crypto-settings-street-1" value="<?php echo $row['user_lname'];?>" readonly>
                                </div>
                            </div>
                        </div>

                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            Sponsor & Placement Info
                        </h2>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Sponsor ID
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="sponsor_id" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Sponsor First Name
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="sponsor_fname" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Sponsor Middle Name
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="sponsor_mname" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Sponsor Last Name
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="sponsor_lname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Placement ID
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="placement_id" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Unit No.
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="placement_number">
                                            <option value="">Please select</option>
                                            <?php
                                            for($c = 1; $c <= 10; $c++)
                                            {
                                                echo '<option value="'.$c.'">'.$c.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Position
                                    </label>
                                    <div class="col-lg-8">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="radio-group1" value="Left" id="placement_left">
                                            <span class="css-control-indicator"></span> Left
                                        </label>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="radio-group1" value="Right" id="placement_right">
                                            <span class="css-control-indicator"></span> Right
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">
                                        Option
                                    </label>
                                    <div class="col-lg-8">
                                        <button type="button" class="btn btn-md btn-noborder btn-primary btn-block" onclick="generate_link()">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<h2 class="content-heading text-muted" style="margin-top: -40px;">
                            Sponsor link
                        </h2>                        
                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Link</label>
                                    <input type="text" class="form-control" id="sponsorsite" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Option</label>
                                    <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block" onclick="copy_link()">Copy link</button>
                                </div>
                            </div>
                        </div>-->
                        <!-- End Personal Details -->  
                    </div>  
                    <div class="block content shadow">
                        <!-- Personal Details -->      
                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            Sponsor list
                        </h2>
                        <div class="mb-20" id="fetch_sponsor"></div>
                    </div>
                    <div class="block content shadow">
                        <!-- Personal Details -->      
                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            Sponsor purchase
                        </h2>
                        <div class="mb-20">
                            
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th>SPONSOR ID</th>
                                        <th>NAME</th>
                                        <th class="d-none d-sm-table-cell">Purchase</th>
                                        <th class="d-none d-sm-table-cell">Amount</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $user_id = $row['user_id'];
                                        $select_purchase = mysqli_query($conn, "SELECT * FROM wp_transaction 
                                            left join wp_member on wp_member.user_id = wp_transaction.transaction_user_id 
                                            left join wp_sponsor on wp_member.user_sponsor_id = wp_sponsor.sponsor_id
                                            WHERE sponsor_to = '$user_id' 
                                            ORDER BY transaction_date DESC");
                                        while($fetch_transaction = mysqli_fetch_array($select_purchase))
                                        {

                                            echo '
                                                <tr>
                                                    <td>'.$fetch_transaction['sponsor_id'].'</td>
                                                    <td>'.$fetch_transaction['user_fname'].' '.$fetch_transaction['user_mname'].' '.$fetch_transaction['user_lname'].'</td>
                                                    <td class="d-none d-sm-table-cell">Token</td>
                                                    <td class="d-none d-sm-table-cell">'.$fetch_transaction['transaction_amount'].'</td>
                                                    <td class="text-center">';                                                
                                                      if($fetch_transaction['transaction_status'] == 'Pending')
                                                      {
                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                      }
                                                      else if ($fetch_transaction['transaction_status'] == 'Cancel' )
                                                      {
                                                        echo '<span class="badge badge-danger">Cancel</span>';
                                                      }
                                                      else if ($fetch_transaction['transaction_status'] == 'Completed' )
                                                      {
                                                        echo '<span class="badge badge-success">Completed</span>';
                                                      }
                                                      else if ($fetch_transaction['transaction_status'] == 'Unlock' )
                                                      {
                                                        echo '<span class="badge badge-primary">Unlock</span>';
                                                      }
                                                      else if ($fetch_transaction['transaction_status'] == 'Paid' )
                                                      {
                                                        echo '<span class="badge badge-dark">Paid</span>';
                                                      }
                                                    echo '
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

                <!-- Normal Modal -->
                <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Sponsor details</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="crypto-settings-street-1">Sponsor ID</label>
                                                <input type="text" class="form-control" id="modal_sponsor_id" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="crypto-settings-street-1">Name</label>
                                                <input type="text" class="form-control" id="modal_name" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="crypto-settings-street-1">Link</label>
                                                <input type="text" class="form-control" id="modal_sponsorsite" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="crypto-settings-street-1">Option</label>
                                                <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block" onclick="copy_link1()">Copy link</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Normal Modal -->
                <?php 
                } 
                else {?>

                <div class="block content shadow">
                    <!-- Personal Details -->      
                    <h2 class="content-heading text-muted" style="margin-top: -40px;">
                        Sponsor list
                    </h2>
                    <div class="mb-20" id="fetch_sponsor"></div>
                </div>

                <?php 
                } ?>
            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script> 

        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_tables_datatables.min.js"></script>

        <script type="text/javascript">
            display_sponsor();
            function display_sponsor()
            {
                user_type = "<?php echo $row['user_type']; ?>";
                user_id = <?php echo $row['user_id']; ?>;
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST', 
                    async: false,
                    data:{
                        user_id:user_id,
                        user_type:user_type,
                        fetch_sponsor: 1,
                    },
                        success: function(response){
                            $('#fetch_sponsor').html(response);
                        }
                });
            }
            function sponsor_click(id)
            {
                document.getElementById("modal_sponsor_id").value = id;
                fname = document.getElementById("sponsor_fname" + id).value;
                lname = document.getElementById("sponsor_lname" + id).value;
                document.getElementById("modal_name").value = fname + ' ' + lname;
                document.getElementById("modal_sponsorsite").value = "http://infinityhub-server.com/redfootprint/member-page/"+fname+"-"+lname+"/";
            }
            function generate_link()
            {
                user_id = <?php echo $row['user_id']; ?>;
                sponsor_id = document.getElementById("sponsor_id").value;
                sponsor_fname = document.getElementById("sponsor_fname").value;
                sponsor_mname = document.getElementById("sponsor_mname").value;
                sponsor_lname = document.getElementById("sponsor_lname").value;
                placement_id = document.getElementById("placement_id").value;
                placement_number = document.getElementById("placement_number").value;

                left = document.getElementById("placement_left");
                placement_left = document.getElementById("placement_left").value;
                right = document.getElementById("placement_right");
                placement_right = document.getElementById("placement_right").value;

                if (left.checked == true)
                { position = placement_left; } 
                else if (right.checked == true)
                { position = placement_right; }  
                else { position = ""; }

                if(sponsor_id == "" || sponsor_fname == "" || sponsor_lname == "" || placement_id == "" || placement_number == "" || position == "")
                {
                    alert('Please complete the application!')
                }
                else
                {
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: "ajax.php",
                            data: {
                                user_id:user_id,
                                sponsor_id:sponsor_id,
                                sponsor_fname:sponsor_fname,
                                sponsor_mname:sponsor_mname,
                                sponsor_lname:sponsor_lname,
                                placement_id:placement_id,
                                placement_number:placement_number,
                                position:position,
                                save_sponsor_and_placement: 1,
                            },
                            success: function(data){
                                if(data == 'sponsorid')
                                { 
                                    alert('Sponsor ID already exist, please try again.');
                                    document.getElementById("sponsor_id").value = "";
                                    $('#sponsor_id').focus();
                                }
                                else if(data == 'placementid')
                                { 
                                    alert('Sponsor placement ID already exist, please try again.');
                                    document.getElementById("placement_id").value = "";
                                    $('#placement_id').focus();
                                }
                                else 
                                { 
                                    alert('Sponsor added successfully.'); 
                                    clear(); 
                                    //document.getElementById("sponsorsite").value = "http://infinityhub-server.com/redfootprint/member-page/nicodame-aucila/";
                                    /*document.getElementById("sponsorsite").value = "http://infinityhub-server.com/redfootprint/member-page/"+sponsor_fname.replace(" ", "-")+"-"+sponsor_lname.replace(" ", "-")+"/";
                                    display_sponsor();*/
                                    location.reload();
                                }
                            }
                        });                
                    });                   
                }
            }
            function clear()
            {
                document.getElementById("sponsor_id").value = "";
                document.getElementById("sponsor_fname").value = "";
                document.getElementById("sponsor_mname").value = "";
                document.getElementById("sponsor_lname").value = "";
                document.getElementById("placement_id").value = "";
                document.getElementById("placement_number").value = "";
                document.getElementById("placement_left").checked = false;
                document.getElementById("placement_right").checked = false;

                document.getElementById("sponsorsite").value = "";
            }
            /*function copy_link()
            {
                var copyText = document.getElementById("sponsorsite");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
            }*/
            function copy_link1()
            {
                var copyText = document.getElementById("modal_sponsorsite");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
            }
        </script>
    </body>
</html>