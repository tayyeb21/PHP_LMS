<html>
<head>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="assets/css/login.css" rel="stylesheet">
	<script src="assets/js/jquery.3.2.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<title>LMS:: Library Management System</title>
</head>
<body>
    <div class="container">
    <h1 class="welcome text-center">Welcome to <br> LMS</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr/>
		<div class="err_msg">
		<?php
		if(isset($_GET['val']))
		{
			if($_GET['val']==0)
			{
				echo "<span style='color:red'>Please Login to continue</span>";
			}
			elseif($_GET['val']==1)
			{
				echo "<span style='color:red'>Please login as administrator</span>";
			}

		}
		?>
		</div>
            <form class="form-signin" id="login_frm" name="login_frm">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">User Name</p>
                <input type="text" id="username" class="login_box form-control" placeholder="User Name" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="pswd" class="login_box form-control" placeholder="******" required>
                <div id="remember" class="checkbox">
                    <label>
                        
                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit" >Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
<script>
		$("#login_frm").submit(function(){
			check_login();
			return false;
		});
		
	function check_login()
	{
		var user_name=$("#username").val();
		var pswd=$("#pswd").val();
		$.ajax({
			type:"POST",
			url:"login_checker.php",
			data:{user_name:user_name,pswd:pswd},
			success:function(res)
			{
				// alert(res);
				if(res==1)
				{
					window.location.href="dashboard/";
				}
				else{
					$(".err_msg").html("Invalid User Name or Password");
				}	
			}	
		});
		//go to login_checker.php
	}
	<?php
		/* if(isset($_GET['val']))
		{
			if($_GET['val']==0)	{
			echo " document.getElementById('.err_msg').innerHTML = 'Please login to continue'";
			}
			elseif($_GET['val']==1)
			{
				echo "document.getElementById('.err_msg').innerHTML = 'Please login as administrator'";
			}
		} */
	?>
</script>
</body>
</html>