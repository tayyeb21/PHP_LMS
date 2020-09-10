<html>
<head>
<?php
	/*include('../db/inc_db.php');
	include('../inner_linking_files.php');
	include('../session_checker.php');
	include('../footer_include_inner.php');
	include('../header_include_inner.php');
	include('../left_navigation_include_inner.php');
	*/
	$page="dashboard";
	include('../header_include_inner.php');	
	?>
<!--
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
	<script src="assets/js/jquery.3.2.1.min.js"></script>	
	<script src="assets/js/bootstrap.min.js"></script>
-->
<!------ Include the above in your HEAD tag ---------->
	<title>LMS:: Library Management System</title>

 

</head>
<body>
<?php /**
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
     <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		<a class="navbar-brand" href="dashboard.php">
			<img src="assets/images/logo.png" height="40px" alt="LMS-Logo">
		</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
      </div><!-- /.container-collapse -->
  </nav>	
  <!------------- MAIN PAGE CONTENT AREA --------->
 <div class="site-panel"style="margin-top:110px">
    <div class="container">
        <div class="row">
                <div class="col-md-3 well">
                    <div class= "sidebar">
                        <div class="list-group">
  <a href="dashboard.php" class="list-group-item active">Dashboard </a>
  <a href="issue/" class="list-group-item ">Issue</a>
  <a href="student/" class="list-group-item">Student</a>
  <a href="book/" class="list-group-item">Books</a>
  <a href="class/" class="list-group-item">Class</a>
  <a href="publisher/" class="list-group-item">Publishers</a>
  <a href="author/" class="list-group-item">Authors</a>
  <a href="user/" class="list-group-item">User</a>
  <a href="transaction/" class="list-group-item">Transaction</a>
</div> 
                    </div>
                </div> 
                <div class="col-md-9 ">
                    <div class= "content-box well">
                     <legend>Dashboard </legend>
                     
                     <div class="row">
	   <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3>
			<?php
				//code to get all the books count from the table.
				 $objLms->getAllBooksCount();
			?>
			</h3>
	        <h5>Books Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3>
			<?php
				//code to get all the books count from the table.
				 $objLms->getAllAuthorsCount();
			?>
			</h3>
	        <h5>Authors Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllPublishersCount(); ?></h3>
	        <h5>Publishers Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllStudentCount(); ?></h3>
	        <h5>Students Count</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllClassCount(); ?></h3>
	        <h5>Classes In College</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="#">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllIssueCount(); ?></h3>
	        <h5>Books Issued until Now</h5>
	        </div>
	        </a>
	    </div>
	</div>
                    
                    
          
    </div>
    </div>
        </div>
    </div>
 </div>
 
  <div class="footer-area ">
    <div class="footer ">
	<div class="container">
		<div class="col-md-4 footer-one">
			</div>	
		</div>
		<div class="col-md-3 footer-two">
		    		</div>
		
		<div class="clearfix"></div>
	</div>
</div>
**/ ?>


</body>
</html>