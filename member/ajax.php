<?php
	include("../conn.php");

    // ----------------------- MEMBER UPLOAD PROFILE PICTURE -----------------------
    if(isset($_POST['update_profile']))
    { 
        $user_id = $_POST['user_id'];
        $attachment_name = $_FILES['file_attachment']['name'];
        $attachment_temp = $_FILES['file_attachment']['tmp_name'];
        $attachment_size = $_FILES['file_attachment']['size'];

        $exp = explode(".", $attachment_name);
        $ext = end($exp);
        $allowed_ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
        if(in_array($ext, $allowed_ext)) // check the file extension
        {
            date_default_timezone_set('Asia/Manila');
            //$todays_date = date("y-m-d H:i:sa"); //  original format
            $date = date("His"); // for unique file name

            $words = explode(' ',trim($attachment_name)); // convert name to array
            $get_name = substr($words[0], 0, 6); // get only 6 character of the name

            $image = $date.'-'.$get_name.'.'.$ext;
            $location = "../assets/media/upload/".$image; // upload location
            if($attachment_size < 3000000) // Maximum 3 MB;
            {
                $select_user = mysqli_query($conn, "SELECT * FROM wp_member where user_id = '$user_id'");
                $fetch_user = mysqli_fetch_array($select_user);
                $existing_frofile = $fetch_user['user_profile_pic'];
                if($existing_frofile != "")
                {
                    array_map('unlink', glob("../assets/media/upload/".$existing_frofile)); // remove image
                }
                move_uploaded_file($attachment_temp, $location);
                $update = mysqli_query($conn, "UPDATE wp_member SET user_profile_pic = '$image' WHERE user_id='$user_id'") or die(mysqli_error());  
                echo "success";
            }
            else
            {
                echo "size";
            }
        }
        else
        {
            echo "format";
        }  
    }
    // ----------------------- END MEMBER UPLOAD PROFILE PICTURE -----------------------
    // ----------------------- DISPLAY MEMBER IN ADMIN SIDE -----------------------
    if(isset($_POST['get_member']))
    { 
        $member_id = $_POST['member_id'];
        $select_member = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_id = '$member_id'");  
        $fetch_select_member = mysqli_fetch_array($select_member);
        ?>
        <div class="row items-push">
            <div class="col-lg-4">
                <div class="block block-themed text-center">
                    <div class="block-content block-content-full block-sticky-options pt-30" style="background-color: #e6e6e6;">
                        <?php if($fetch_select_member['user_profile_pic'] != ""): ?>
                            <img class="prof" src="../assets/media/upload/<?php echo $fetch_select_member['user_profile_pic']; ?>">
                        <?php else: ?>
                            <img class="prof" src="../assets/media/photos/avatarpic.jpg">
                        <?php endif; ?>  
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-gd-pulse">
                        <div class="font-w600 text-white mb-5"><?php echo $fetch_select_member['user_fname'] . " " . $fetch_select_member['user_mname'] . " " . $fetch_select_member['user_lname'];?></div>
                        <div class="font-size-sm text-white-op">Contact Name</div>
                    </div>
                </div>                                   
            </div>
            <div class="col-lg-8">
                <div class="form-group row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Username</label>
                            <input type="text" class="form-control" id="admin_username" value="<?php echo $fetch_select_member['user_username'];?>" readonly>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Password</label>
                            <input type="text" class="form-control" id="admin_password" value="<?php echo $fetch_select_member['user_rp'];?>" readonly>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">First Name</label>
                            <input type="text" class="form-control" id="admin_fname" value="<?php echo $fetch_select_member['user_fname'];?>" required>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Middle Name</label>
                            <input type="text" class="form-control" id="admin_mname" value="<?php echo $fetch_select_member['user_mname'];?>">
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Last Name</label>
                            <input type="text" class="form-control" id="admin_lname" value="<?php echo $fetch_select_member['user_lname'];?>" required>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Birthdate</label>
                            <input type="date" class="form-control" id="admin_bdate" value="<?php echo $fetch_select_member['user_bdate'];?>" required>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Contact #</label>
                            <input type="text" class="form-control" id="admin_contact" value="<?php echo $fetch_select_member['user_contact_no'];?>" required>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Email</label>
                            <input type="text" class="form-control" id="admin_email" value="<?php echo $fetch_select_member['user_email'];?>" required>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Address</label>
                            <input type="text" class="form-control" id="admin_address" value="<?php echo $fetch_select_member['user_address'];?>" required>
                         </div>
                         <div class="form-group">
                            <label for="crypto-settings-street-1">Option</label>
                            <button type="button" class="btn btn-md btn-noborder btn-primary btn-block" onclick="update_contact()">Update details</button>
                         </div>
                    </div>
                </div>                                      
            </div>
        </div>
        <?php
    }
    // ----------------------- END DISPLAY MEMBER IN ADMIN SIDE -----------------------
    // ----------------------- UPDATE MEMBER IN ADMIN SIDE -----------------------
    if(isset($_POST["update_contact"]))  
    {
        $member_id = $_POST['member_id']; 
        $fname = $_POST['admin_fname']; 
        $mname = $_POST['admin_mname']; 
        $lname = $_POST['admin_lname']; 
        $bdate = $_POST['admin_bdate']; 
        $admin_contact = $_POST['admin_contact']; 
        $admin_email = $_POST['admin_email']; 
        $admin_address = $_POST['admin_address']; 

        mysqli_query($conn, "UPDATE wp_member SET 
            user_fname='$fname', 
            user_mname='$mname', 
            user_lname='$lname', 
            user_bdate='$bdate', 
            user_contact_no='$admin_contact', 
            user_email='$admin_email', 
            user_address='$admin_address'  WHERE user_id = '$member_id'") or die(mysqli_error());
    }
    // ----------------------- END UPDATE MEMBER IN ADMIN SIDE -----------------------

    // ----------------------- MODAL DISPLAY TRANSACTION IN ADMIN SIDE -----------------------
    if(isset($_POST["display_transaction"]))  
    {
        $tx_id = $_POST['tx_id']; 
        $select_transaction = mysqli_query($conn, "SELECT * FROM wp_transaction WHERE transaction_num = '$tx_id'");  
        $fetch = mysqli_fetch_array($select_transaction);

        $member_id = $fetch['transaction_user_id'];        
        $select_member = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_id = '$member_id'");
        $fetch_name = mysqli_fetch_array($select_member);
        $fullname = $fetch_name['user_fname'].' '.$fetch_name['user_mname'].' '.$fetch_name['user_lname'];
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wizard-simple-firstname">Date</label>
                        <input type="text" class="form-control" value="<?php echo $fetch['transaction_date']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wizard-simple-firstname">Name</label>
                        <input type="text" class="form-control" value="<?php echo $fullname; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wizard-simple-firstname">Currency</label>
                        <input type="text" class="form-control" value="<?php echo $fetch['transaction_currency']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wizard-simple-firstname">Amount</label>
                        <input type="text" class="form-control" value="<?php echo $fetch['transaction_amount']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="wizard-simple-firstname">Status</label>
                <?php
                    if($fetch['transaction_status'] == "Pending")
                    {
                        echo '<input type="text" class="form-control bg-gd-sun text-white" value="'.$fetch['transaction_status'].'" readonly>';
                    }
                    else
                    {
                        echo '<input type="text" class="form-control" value="'.$fetch['transaction_status'].'" readonly>';
                    }
                ?> 
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="wizard-simple-firstname">Option</label>
                <?php
                    if($fetch['transaction_status'] == "Pending")
                    {
                        echo '
                        <button type="button" class="btn btn-danger btn-block" id="'.$fetch['transaction_user_id'].'" onclick="approve_transaction(this.id)">
                            <i class="fa fa-check"></i> Approve
                        </button>';
                    }
                    else
                    {
                        echo '
                        <button type="button" class="btn bg-default-dark btn-block" disabled>
                            <span class="text-white"><i class="fa fa-check"></i> Approve</span>
                        </button>';
                    }
                ?>
                </div>
            </div>
            <br>
        <?php
    }
    // ----------------------- END MODAL DISPLAY TRANSACTION IN ADMIN SIDE ----------------------- 
    // ----------------------- APPROVE TRANSACTION IN ADMIN SIDE ----------------------- 
    if(isset($_POST['approve_transaction']))
    { 
        $user_id = $_POST['member_id'];
        $transaction = $_POST['tx_id'];

        $select_transaction = mysqli_query($conn, "SELECT * FROM wp_transaction WHERE transaction_num = '$transaction'");
        $fetch_transaction = mysqli_fetch_array($select_transaction);
        $item_number = $fetch_transaction['transaction_item_num'];
        $amount = $fetch_transaction['transaction_amount'];

        if($item_number == "1")
        { $token = 100; }
        else if($item_number == "2")
        { $token = 200; }
        else if($item_number == "3")
        { $token = 400; }
        else if($item_number == "4")
        { $token = 800; }
        else if($item_number == "5")
        { $token = 1600; }
        else
        { $token = 3200; }

        $update = mysqli_query($conn, "UPDATE wp_transaction SET transaction_status = 'Completed' WHERE transaction_num = '$transaction'") or die(mysqli_error()); 
        $select_user = mysqli_query($conn, "SELECT * FROM wp_usermeta WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'");
        $fetch_user = mysqli_fetch_array($select_user);
        $user_token = $fetch_user['meta_value'];

        if($user_token == "") // if no token ever since
        {
            mysqli_query($conn, "UPDATE wp_usermeta SET meta_value='$token' WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'") or die(mysqli_error());
        }
        else // else update token
        {
            $new_token = $user_token + $token;
            mysqli_query($conn, "UPDATE wp_usermeta SET meta_value='$new_token' WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'") or die(mysqli_error());
        }
    }
    // ----------------------- APPROVE TRANSACTION IN ADMIN SIDE -----------------------    

    // ----------------------- ADD AGENT ----------------------- 
    if(isset($_POST['add_affiliate']))
    { 
        $view_affiliate_id = $_POST['view_affiliate_id'];

        $member_id = $_POST['member_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $bdate = $_POST['bdate'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if($view_affiliate_id == "")
        {
            mysqli_query($conn, "INSERT INTO wp_affiliate VALUES('',NOW(),'$member_id','$fname','$mname','$lname','$bdate','$contact','$email','$address','')") or die(mysqli_error());
            echo 'insert';
        }
        else
        {
            mysqli_query($conn, "UPDATE wp_affiliate SET affiliate_fname = '$fname', affiliate_mname = '$mname', affiliate_lname = '$lname', affiliate_bday = '$bdate', affiliate_contact_no = '$contact', affiliate_email = '$email', affiliate_address = '$address' WHERE affiliate_id = '$view_affiliate_id'") or die(mysqli_error());
            echo 'update';
        }
    }
    // ----------------------- END ADD AGENT ----------------------- 

	// ----------------------- DISPLAY SPONSOR ----------------------- 
    if(isset($_POST['fetch_sponsor']))
    { 
        $user_id = $_POST['user_id'];
        $user_type = $_POST['user_type'];
    	echo '
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-hover">
            <thead>
                <tr>
                    <th>SPONSOR ID</th>';
                        if($user_type == "Admin")
                        {
                           echo '<th class="d-none d-sm-table-cell">Sponsor By</th>'; 
                        }
                    echo'
                    <th>NAME</th>
                    <th class="d-none d-sm-table-cell">PLACEMNET ID</th>
                    <th class="d-none d-sm-table-cell">Unit No.</th>
                    <th>POSITION</th>
                    <th class="text-center">Profile</th>
                </tr>
            </thead>
            <tbody>';
                if($user_type == "Admin")
                {
                    $results = mysqli_query($conn, "SELECT * FROM wp_sponsor left join wp_member on wp_member.user_sponsor_id = wp_sponsor.sponsor_id ORDER BY sponsor_name ASC");
                }   
                else
                {
                    $results = mysqli_query($conn, "SELECT * FROM wp_sponsor left join wp_member on wp_member.user_sponsor_id = wp_sponsor.sponsor_id WHERE sponsor_to = '$user_id' ORDER BY sponsor_name ASC");
                }          
                while($rows = mysqli_fetch_array($results))
                {
                    $sponsor_to = $rows['sponsor_to'];
                    $select_member = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_id = '$sponsor_to'");
                    $fetch_member = mysqli_fetch_array($select_member);

                    $fname = $rows['user_fname'];
                    $lname = $rows['user_lname'];
                    echo '
                    <tr id="'.$rows['sponsor_id'].'" onclick="sponsor_click(this.id)" style="cursor: pointer;" data-toggle="modal" data-target="#modal-normal">
                        <td>
                            '.$rows['sponsor_id'].'
                        </td>';
                            if($user_type == "Admin")
                            {
                               echo '<td class="d-none d-sm-table-cell">'.$fetch_member['user_fname'][0].' '.$fetch_member['user_mname'].' '.$fetch_member['user_lname'].'</td>'; 
                            }
                        echo'
                        <td>
                            '.$rows['sponsor_name'].'
                        	<input type="hidden" class="form-control" value="'.str_replace(" ","-",$fname).'" id="sponsor_fname'.$rows['user_sponsor_id'].'">
                            <input type="hidden" class="form-control" value="'.str_replace(" ","-",$lname).'" id="sponsor_lname'.$rows['user_sponsor_id'].'">
                        </td>
                        <td class="d-none d-sm-table-cell">
                            '.$rows['sponsor_place_id'].'
                        </td>
                        <td class="d-none d-sm-table-cell">
                            '.$rows['sponsor_place_num'].'
                        </td>
                        <td>
                            '.$rows['sponsor_place_position'].'
                        </td>                        
                        <td class="text-center">';
                            if($rows['user_profile_pic'] != "")
                            {echo'<img style="width: 37px; height: 37px; border-radius:50px;" src="../assets/media/upload/'.$rows['user_profile_pic'].'">';}
                            else
                            {echo '<img style="width: 37px; height: 37px; border-radius:50px; border: 2px solid #e2e2e2;" src="../assets/media/photos/avatarpic.jpg">';}
                            echo'
                        </td>
                    </tr>';
                }
                echo'
            </tbody>
        </table>';
    }
	// ----------------------- END DISPLAY SPONSOR ----------------------- 
	// ----------------------- SAVE SPONSOR & PLACEMNET ----------------------- 
    if(isset($_POST['save_sponsor_and_placement']))
    { 
        $user_id = $_POST['user_id'];
        $sponsor_id = $_POST['sponsor_id'];
        $fname = $_POST['sponsor_fname'];
        $mname = $_POST['sponsor_mname'];
        $lname = $_POST['sponsor_lname'];
        $sponsor_name = $fname.' '.$mname.' '.$lname;
        $sponsor_dash = str_replace(" ","-",$fname).'-'.str_replace(" ","-",$lname); // $fname.'-'.$lname;
        $placement_id = $_POST['placement_id'];
        $placement_number = $_POST['placement_number'];
        $position = $_POST['position'];
        $username = $fname.$sponsor_id;
        $length = 10;    
        $real_password =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,$length);
        $password = md5($real_password);
        $type = "Sponsor";

        $select_sponsor_id = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_sponsor_id = '$sponsor_id'");
        $count_sponsor = mysqli_num_rows($select_sponsor_id);
        if($count_sponsor == 0)
        {
	        $select_placement_id = mysqli_query($conn, "SELECT * FROM wp_sponsor WHERE sponsor_place_id = '$placement_id'");
	        $count_placement = mysqli_num_rows($select_placement_id);
	        if($count_placement == 0)
	        {
	        	mysqli_query($conn, "INSERT INTO wp_sponsor VALUES('$sponsor_id','$sponsor_name','$user_id','$placement_id','$placement_number','$position')") or die(mysqli_error());
                mysqli_query($conn, "INSERT INTO wp_member VALUES('','$sponsor_id','$fname','$mname','$lname','','','','','$username','$password','$type','','$real_password')") or die(mysqli_error());

                mysqli_query($conn, "INSERT INTO wp_users (user_login, user_pass, user_email, display_name) VALUES('$username','$password','','$sponsor_name')") or die(mysqli_error());
                $last_id = mysqli_query($conn,"SELECT * FROM wp_users ORDER BY ID DESC LIMIT 1"); // get last ID
                $fetch_last_id = mysqli_fetch_array($last_id);  
                $last = $fetch_last_id['ID'];

                mysqli_query($conn, "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('$last','wp_capabilities', 'a:1:{s:10:\"subscriber\";b:1;}'), ('$last','wp_user_level', '0'), ('$last','um_user_profile_url_slug_name_dash', '$sponsor_dash'), ('$last','first_name', '$fname'), ('$last','last_name', '$lname'), ('$last','mwb_wpr_points', '')") or die(mysqli_error());
	        }
	        else
	        {
	        	echo 'placementid';
	        }
        }
        else
        {
        	echo 'sponsorid';
        }
    }
	// ----------------------- END SAVE SPONSOR & PLACEMNET ----------------------- 
?>