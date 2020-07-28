<?php
$user_id = $row['user_id'];
$user_type = $row['user_type'];
$user_rp = $row['user_rp'];
$select_user_login = mysqli_query($conn, "SELECT * FROM wp_users WHERE ID = '$user_id'");
$fetch_user_login = mysqli_fetch_array($select_user_login);
$user = $fetch_user_login['user_login'];
?>

<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <div class="content-header content-header-fullrow px-15">
            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Normal Mode -->
        </div>

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <a class="img-link" href="personal_details.php">
                    <?php if($row['user_profile_pic'] != ""): ?>
                        <img class="img-avatar img-avatar32" src="../assets/media/upload/<?php echo $row['user_profile_pic']; ?>">
                    <?php else: ?>
                        <img class="img-avatar img-avatar32" src="../assets/media/photos/avatarpic.jpg">
                    <?php endif; ?>                               
                </a>
            </div>

            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="personal_details.php">
                    <?php if($row['user_profile_pic'] != ""): ?>
                        <img class="img-avatar" src="../assets/media/upload/<?php echo $row['user_profile_pic']; ?>">
                    <?php else: ?>
                        <img class="img-avatar" src="../assets/media/photos/avatarpic.jpg">
                    <?php endif; ?>                               
                </a>

                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <span class="d-sm-inline-block"><?php echo $row['user_fname'];?></span>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                           <i class="si si-drop"></i>
                        </a>
                    </li>

                    <?php 
                        if($user_type == "Admin")
                        {
                            echo '<span class="badge badge-primary">'.$row['user_type'].'</span> ';
                        }
                        else
                        {
                            echo '<span class="badge" style="background-color: #920d00;">'.$row['user_type'].'</span> ';
                        }
                    ?>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <?php
                    $bg_color0 = ""; $bg_color1 = ""; $bg_color2 = ""; $bg_color3 = ""; $bg_color4 = ""; 

                    if($highlight == "affiliate_dashboard.php")
                    { $bg_color0 = "#920d00"; }
                    else{}
                ?>
                <li>
                    <a href="affiliate_dashboard.php" style="background: <?php echo $bg_color0; ?>;"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a href="affiliate_earnings.php" style="background: <?php echo $bg_color1; ?>;"><i class="si si-wallet"></i><span class="sidebar-mini-hide">Earnings</span></a>
                </li>
                <li>
                    <a href="personal_rewards.php" style="background: <?php echo $bg_color2; ?>;"><i class="si si-badge"></i><span class="sidebar-mini-hide">Reward</span></a>
                </li>
                <li>
                    <a href="affiliate_creative.php" style="background: <?php echo $bg_color3; ?>;"><i class="si si-book-open"></i><span class="sidebar-mini-hide">Creative</span></a>
                </li>
                <li>
                    <a href="affiliate_creative.php" style="background: <?php echo $bg_color4; ?>;"><i class="si si-logout"></i><span class="sidebar-mini-hide">Sign out</span></a>
                </li>

            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>

<!-- END Sidebar -->