<html>
<head>
<title>LMS::Library Management System</title>
<?php 
include('db/inc_db.php');
include('session_checker_inner.php');
include('linking_files.php');
?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
     <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		<a class="navbar-brand" href="dashboard.php">
			<img src="assets/images/lms_logo.jpg" height="40px" alt="LMS-Logo">
		</a>
    </div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
		<li><a style="color:#337AB7" href="#"><span class="glyphicon glyphicon-user"></span>Profile</a>
        <li><a style="color:#337AB7" href="../logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
      </div><!-- /.container-collapse -->
  </nav>

<div class="site-panel" style="margin-top:110px">
    <div class="container">
        <div class="row">
                <div class="col-md-3 well">
                    <div class= "sidebar">
                        <div class="list-group">
  <a href="" class="list-group-item <?php echo (($page=="dashboard")?'active':''); ?>" onClick="show_dashboard();">Dashboard </a>
  <a href="" class="list-group-item <?php echo (($page=="issue")?"active":""); ?>" onClick="show_issue();">Issue</a>
  <a href="../student/" class="list-group-item <?php echo (($page=="student")?'active':''); ?>">Student</a>
  <a href="../book/" class="list-group-item <?php echo (($page=="book")?'active':''); ?>">Books</a>
  <a href="../class/" class="list-group-item <?php echo (($page=="class")?'active':''); ?>">Class</a>
  <a href="../publisher/" class="list-group-item <?php echo (($page=="publisher")?'active':''); ?>">Publishers</a>
  <a href="../author/" class="list-group-item <?php echo (($page=="author")?'active':''); ?>">Authors</a>
  <a href="../user/" class="list-group-item <?php echo (($page=="user")?'active':''); ?>">User</a>
  <a href="../transaction/" class="list-group-item <?php echo (($page=="transaction")?'active':''); ?>">Transaction</a>
</div> 
                    </div>
                </div>
                <div class="col-md-9 ">
                    <div class= "content-box well"  >
                     <legend><?php echo ucfirst($page); ?> </legend>
					 <div class='row'>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo ucfirst($page); ?></h4>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<div id="content" class="table-responsive"> Content will load here </div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- Footer Area -->
    <div class="footer-bottom">
        <div class="container">
					<div class="row">
						<div class="col-sm-12 text-center ">
							<div class="copyright-text">
								<p>CopyRight © 2018 LMS :: Library Management System</p>
							</div>
						</div> <!-- End Col -->
						
					</div>
				</div>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
	 /*$("#data-toggle").click(function(){
        $("#myModal").modal();
	 });*/
	load_input_table();
	load_data();
});

function load_input_table()
{
	$.ajax({
		type:"POST",
		url:"back_operation.php",
		data:{operation:"input"},
		success:function(response){
			$("#modal-body").html(response)
		}
	});
}
/*function load_data()
{
	$.ajax({
		type:"POST",
		url:"back_operation.php",
		data:{operation:"r"},
		success:function(response){
			//alert(response);
			$("#content").html(response)
		}
	});
}*/
function show_dashboard()
{
	$.ajax({
		type:'POST',
		url:'dashboard/back_operation.php',
		data:{operation:'r'},
		success:function(response)
		{
			$("#content").html(response)
		}
	});
}
function show_issue()
{
	$.ajax({
		type:'POST',
		url:'issue/back_operation.php',
		data:{operation:'r'},
		success:function(response)
		{
			$("#content").html(response)
		}
	});
}

</script>
