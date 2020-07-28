<?php 
	// CUSTOME Code to auto login from "custom web" to "WP" - auto login to "WP"

	if (empty($_GET['user'])) 
	{
		$user = "";
		$user_rp = "";
	}
	else
	{
		$user = $_GET['user'];
		$user_rp = $_GET['user_rp'];
	}
?>

		<form name="loginform" id="loginform" action="" method="post">
			<p>
				<label for="user_login">Username or Email Address</label>
				<input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" />
			</p>

			<div class="user-pass-wrap">
				<label for="user_pass">Password</label>
				<div class="wp-pwd">
					<input type="password" name="pwd" id="user_pass" class="input password-input" value="" size="20" />
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="" id="btnStartVisit" onclick="sample()">Login
						<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</form>

<script type="text/javascript">
	user = "<?php echo $user; ?>";
	user_rp = "<?php echo $user_rp; ?>";

	document.getElementById("user_login").value = user;
	document.getElementById("user_pass").value = user_rp;
	if(user != "")
	{
		document.getElementById('btnStartVisit').dispatchEvent(new MouseEvent("click"));
	}
</script>