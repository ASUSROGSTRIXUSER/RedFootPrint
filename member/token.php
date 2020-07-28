<?php include ("session.php"); ?> 
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "token.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <!--<div class="content-heading" style="margin-top: -50px;">
                        <div class="float-right">
                            <button type="button" class="open-homeEvents btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-large">Token Info
                            </button>
                        </div>
                        Reward <small>token</small>
                    </div>-->   
                    <div class="my-50 text-center"><h3 class="h5 text-muted mb-0">TOTAL TOKEN</h3>
                        <h1 class="font-w700 text-black mb-10">
                            <?php 
                                $user_id = $row['user_id']; 
                                $select_token = mysqli_query($conn, "SELECT * FROM wp_usermeta WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'");
                                $fetch_token = mysqli_fetch_array($select_token);
                                if($fetch_token['meta_value'] == "")
                                { echo '0'; } 
                                else
                                { echo $fetch_token['meta_value']; } 
                            ?>
                        </h1>
                        <h3 class="h5 text-muted mb-0">Hurry! Buy another token now!</h3>
                    </div>

                        <div class="row">
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-dusk font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">100 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱100 worth of money</div>
                                        </div> 
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="MWDFZQ9WK36MN">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-sea font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">200 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱200 worth of money</div>
                                        </div>                      
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="LFJFAQV9XCTJN">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-lake font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">400 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱400 worth of money</div>
                                        </div>                    
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="CTC2NS5C5BJ9Y">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-cherry font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">800 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱800 worth of money</div>
                                        </div>                     
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="WAU4HX2AKM7NY">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-sun font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">1,600 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱1,600 worth of money</div>
                                        </div>                   
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="PRAAVAFZ6RR2E">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="block block-fx-shadow text-center">
                                    <a class="d-block bg-gd-leaf font-w600 text-uppercase py-5">
                                        <span class="text-white">REGULAR PRICE</span>
                                    </a>
                                    <div class="block-content block-content-full">
                                        <div class="pt-20 pb-30">
                                            <div class="font-size-h3 font-w700">3,200 TOKEN</div>
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱3,200 worth of money</div>
                                        </div>               
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                            <input type="hidden" name="cmd" value="_s-xclick">
                                            <input type="hidden" name="hosted_button_id" value="JWUQSV8RW2BUN">
                                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>





                    <!-- Large Modal -->
                    <!-- <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="block block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Token Table</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                         <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>₱1.00 = 1 Token</thead>
                                            <thead class="bg-corporate-dark" style="color: #fff;">
                                                <tr>
                                                    <th class="text-center bg-primary">PRICE</th> 
                                                    <th class="text-center bg-primary">TOKEN</th>  
                                                    <th class="text-center bg-primary">DISCOUNT</th>  
                                                    <th class="d-none d-sm-table-cell text-center bg-primary">PERCENTAGE</th>
                                                </tr>
                                            </thead>
                                                <tr>
                                                  <td class="text-center">₱5,000</td> 
                                                  <td class="text-center">50</td> 
                                                  <td class="text-center">0.00</td>     
                                                  <td class="d-none d-sm-table-cell text-center">0%</td> 
                                                </tr>
                                                <tr>
                                                  <td class="text-center">₱9,800‬</td> 
                                                  <td class="text-center">100</td>    
                                                  <td class="text-center">‭200‬.00</td>   
                                                  <td class="d-none d-sm-table-cell text-center">2%</td> 
                                                </tr>
                                                <tr>
                                                  <td class="text-center">₱19,400‬</td> 
                                                  <td class="text-center">200</td>   
                                                  <td class="text-center">‭600‬.00</td>   
                                                  <td class="d-none d-sm-table-cell text-center">3%</td> 
                                                </tr>
                                                <tr>
                                                  <td class="text-center">₱48,000‬</td> 
                                                  <td class="text-center">500</td>   
                                                  <td class="text-center">2,000‬.00</td>   
                                                  <td class="d-none d-sm-table-cell text-center">4%</td> 
                                                </tr>
                                                <tr>
                                                  <td class="text-center">₱95,000‬</td> 
                                                  <td class="text-center">1000</td>  
                                                  <td class="text-center">5,000‬.00</td>    
                                                  <td class="d-none d-sm-table-cell text-center">5%</td> 
                                                </tr>
                                                <tr>
                                                  <td class="text-center">₱188,000‬</td> 
                                                  <td class="text-center">2000</td>   
                                                  <td class="text-center">12,000.00</td>   
                                                  <td class="d-none d-sm-table-cell text-center">6%</td> 
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>
    </body>
</html>