<!DOCTYPE html>
<html>
   <head>
      <style>
         #loader{
         position: absolute;
         left: 50%;
         top: 50%;
         z-index: 1;
         width: 150px;
         height: 150px;
         margin: -75px 0 0 -75px;
         border: 16px solid #f3f3f3;
         border-radius: 50%;
         border-top: 16px solid #337AB7;
         width: 120px;
         height: 120px;
         -webkit-animation: spin 2s linear infinite;
         animation: spin 2s linear infinite;
         }
         @-webkit-keyframes spin {
         0% { -webkit-transform: rotate(0deg); }
         100% { -webkit-transform: rotate(360deg); }
         }
         @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
         }
         /* Add animation to "page content" */
         .animate-bottom {
         position: relative;
         -webkit-animation-name: animatebottom;
         -webkit-animation-duration: 1s;
         animation-name: animatebottom;
         animation-duration: 1s
         }
         @-webkit-keyframes animatebottom {
         from { bottom:-100px; opacity:0 } 
         to { bottom:0px; opacity:1 }
         }
         @keyframes animatebottom { 
         from{ bottom:-100px; opacity:0 } 
         to{ bottom:0; opacity:1 }
         }
         #main_content{
         margin-top:15px;
         }
         .addbtn{
         /* align:right; */
         float:right;
         }
      </style>
      <title>LMS::Library Management System</title>
      <?php 
         include('../db/inc_db.php');
         include('../session_checker_inner.php');
         include('../inner_linking_files.php');
         ?>
         <meta name="viewport" content="width=device-width , initial-scale=1" />
         <meta name="charset" content="utf-8" /> 
   </head>
   <body onload="loader();" style="margin:0;" class="home">
      <?php /*
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
         		<a class="navbar-brand" href="../dashboard/">
         			<img src="../assets/images/lms_logo.jpg" height="40px" alt="LMS-Logo">
         		</a>
             </div>
         	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
         			<li class="dropdown">
         		  <a style="color:#337AB7" class="dropdown-toggle" data-toggle="dropdown" href="#" title="Profile"><span class="glyphicon glyphicon-user"></span> Profile <b class="caret"></b></a>
         			<ul class="dropdown-menu" style="padding: 25px;min-width: 450px;">
                 <li>
                   <div class="row">
                    <div class="col-md-12">
                                 <h4><?php echo $_SESSION["user_full_name"]; ?></h4> <br />
      <div class="col-sm-6 col-md-4">
         <img src="" alt="" class="img-rounded img-responsive" />
      </div>
      <div class="col-sm-6 col-md-8">
         <p>
            <i class="glyphicon glyphicon-envelope"></i> <?php echo $_SESSION["user_name"]; ?>
            <br /> <br />
            <i class="glyphicon glyphicon-globe"></i> <?php echo $_SESSION["user_type"]; ?>
            <br /> <br />
            <!-- <i class="glyphicon glyphicon-gift"></i> </p> -->
      </div>
      </div>
      </div>	
      </li>   
      </ul>
      <li><a style="color:#337AB7" href="../logout.php" title="Log Out"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
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
                        <a href="../dashboard/" class="list-group-item <?php echo (($page=="dashboard")?'active':''); ?>">Dashboard </a>
                        <a href="../issue/" class="list-group-item <?php echo (($page=="issue")?"active":""); ?>">Issue</a>
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
               <div id="loader"></div>
               <div id="main_content" class="animate-bottom">
                  <div class="col-md-9" id="alert_msg" name="alert_msg"></div>
                  <!--for alert message -->
                  <div class="col-lg-9">
                     <div class= "content-box well" >
                        <div class="panel panel-primary">
                           <div class='panel-heading'>
                              <h3><?php echo ucfirst($page); ?></h3>
                           </div>
                           <div class="panel-body">
                              <div class='row'>
                                 <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                       <!--Input form Modal content-->
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
                                 <!-- Delete confirmation Modal --><!-- failed experiment :) -->
                                 <!--  <div class="modal fade" id="confirmModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirm</h4>
                                    </div>
                                    <div class="modal-body" id="modal-body"><strong>Do You Really Want To Delete The Record?</strong>
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" id="yes" name="yes" class="btn btn-danger">Yes</button>
                                     <button type="button" id="No" name="no" class="btn btn-info" data-dismiss="modal">No</button>
                                    </div>
                                     </div>
                                      </div>
                                       </div> 
                                        -->
                                 <div id="content">	</div>
                              </div>
                           </div>
                        </div>
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
                  <div class="copyright-text" style="color:grey;font-family:century gothic">
                     <p>CopyRight &copy; 2018 LMS :: Library Management System</p>
                     <p>Made And Developed By :: Abdul Tayyeb Bohra</p>
                  </div>
               </div>
               <!-- End Col -->
            </div>
         </div>
      </div>
      */ ?>
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
               <div class="logo">
                  <a hef="../dashboard/">
                     <h1 style="color:white; font-family:century gothic"><i class="fa fa-book"></i> Library</h1>
                  </a>
                  <hr/>
               </div>
               <div class="navi">
                  <ul>
                     <li class="<?php echo (($page=="dashboard")?'active':''); ?>"><a href="../dashboard/"><i class="fa fa-tachometer" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                     <li class="<?php echo (($page=="issue")?'active':''); ?>"><a href="../issue/"><i class="fa fa-pencil-square" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Issue</span></a></li>
                     <li class="<?php echo (($page=="student")?'active':''); ?>"><a href="../student/"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Student</span></a></li>
                     <li class="<?php echo (($page=="book")?'active':''); ?>"><a href="../book/"><i class="fa fa-book" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Book</span></a></li>
                     <li class="<?php echo (($page=="class")?'active':''); ?>"><a href="../class/"><i class="fa fa-users" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Class</span></a></li>
                     <li class="<?php echo (($page=="publisher")?'active':''); ?>"><a href="../publisher/"><i class="fa fa-print" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Publisher</span></a></li>
                     <li class="<?php echo (($page=="author")?'active':''); ?>"><a href="../author/"><i class="fa fa-font" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Author</span></a></li>
                     <li class="<?php echo (($page=="user")?'active':''); ?>" <?php echo (($_SESSION['user_type']!="administrator")?'hidden':''); ?>><a href="../user/"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">User</span></a></li>
                     <li class="<?php echo (($page=="transaction")?'active':''); ?>" <?php echo (($_SESSION['user_type']!="administrator")?'hidden':''); ?>><a href="../transaction/"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Transaction</span></a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
               <div class="row">
                  <header>
                     <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                           <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              </button>
                           </div>
                        </nav>
                        <!-- <div class="search hidden-xs hidden-sm">
                           <input type="text" placeholder="Book Search" id="book_search" name="book_search" onKeyUp="book_search();">
                        </div>
                        <div id="result"></div> -->
                     </div>
                     <div class="col-md-5">
                        <div class="header-rightside">
                           <ul class="list-inline header-top pull-right">
                              <li><a href="../aboutus/" class="nav-link"><i class="fa fa-info" aria-hidden="true"></i> About Us</a></li>
                              <li class="dropdown">
                                 <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-user"></i> Profile
                                 <b class="caret"></b></a>
                                 <ul class="dropdown-menu">
                                    <li>
                                       <div class="navbar-content">
                                          <span><?php echo $_SESSION['user_full_name']; ?></span>
                                          <p class="text-muted small">
                                             <?php echo $_SESSION['user_name']; ?>
                                          </p>
                                          <div class="divider">
                                          </div>
                                          <a href="../logout.php" class="view btn-sm active"><i class="fa fa-sign-out" aria-hidden="true" style="color:white;"></i> Log Out</a>
                                       </div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </header>
               </div>
               <div id="loader"></div>
               <div id="main_content" class="animate-bottom">
                  <div class="col-md-11" id="alert_msg" name="alert_msg"></div>
                  <!--for alert message -->
                  <div class="col-lg-11">
                     <div class= "content-box well" style="background-color:white;" >
                        <div class="panel">
                           <div class="panel-heading">
                              <h3><?php echo ucfirst($page); ?></h3>
                           </div>
                           <div class="panel-body">
                              <div class='row'>
                                 <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                       <!--Input form Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title"><?php echo ucfirst($page); ?></h4>
                                          </div>
                                          <div class="modal-body" id="modal-body">
                                          </div>
                                          <!-- <div class="modal-footer">
                                             <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                   </div> -->
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Delete confirmation Modal --><!-- failed experiment :) -->
                                 <div class="modal fade" id="confirmModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title">Confirm</h4>
                                          </div>
                                          <div class="modal-body" id="modal-body"><strong>Do You Really Want To Delete The Record?</strong>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" id="yes" name="yes" class="btn btn-danger" onClick="delete_data();">Yes</button>
                                             <button type="button" id="No" name="no" class="btn btn-info" data-dismiss="modal">No</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Warining Modal for empty fields -->
                                 <div class="modal fade" id="warningModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title">Warning</h4>
                                          </div>
                                          <div class="modal-body" id="modal-body"><strong>Please fill out all the fields</strong>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" id="yes" name="yes" class="btn btn-add" data-dismiss="modal">Ok</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="content">	</div>
                              </div>
                           </div>
                        </div>
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
                  <div class="copyright-text" style="color:grey;font-family:century gothic">
                     <p>CopyRight &copy; 2018 LMS :: Library Management System</p>
                     <p>Made And Developed By :: Abdul Tayyeb Bohra</p>
                  </div>
               </div>
               <!-- End Col -->
            </div>
         </div>
      </div>
      <!-- Modal -->
   </body>
</html>
<script>
   /*$(document).ready(function(){   // alternate way to toggle the modal
   	 $("#data-toggle").click(function(){
           $("#myModal").modal();
   	 });
   	load_input_table();
   });*/
   $(document).ready(function(){
      $('[data-toggle="offcanvas"]').click(function(){
          $("#navigation").toggleClass("hidden-xs");
      });
   });
   
   function loader()
   {
   	$(document).ready(function(){
   	load_data();
   	});
   }
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
   function load_data()
   {
   	document.getElementById("loader").style.display="none";
   	document.getElementById("main_content").style.display="block";
   	$.ajax({
   		type:"POST",
   		url:"back_operation.php",
   		data:{operation:"r"},
   		success:function(response){
   			//alert(response);
   			$("#content").html(response);
   		}
   	});
   }
   function book_search()
   {
     var input = $("#book_search").val();
     $.ajax({
       type:"POST",
       url:"../header_include_inner.php",
       data:{input:input,operation:"bsearch"},
       success:function(response){
         $("#book_search").html(response);
       } 
     });
   }
   /* alert calling function */	
   var myVar;
   function success_insert_alert()
   {
   	$("#alert_msg").html("<div class='alert alert-success alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Succcessfully Data Inserted </div>");
   }
   function fail_insert_alert()
   {
   	$("#alert_msg").html("<div class='alert alert-warning alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Failed to Insert Data </div>");
   }
   function success_update_alert()
   {
   	$("#alert_msg").html("<div class='alert alert-info alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Updated Data Succcessfully </div>");
   }
   function fail_update_alert(response)
   {
   	$("#alert_msg").html("<div class='alert alert-warning alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Failed to Update Data"+response+"</div>");
   }
   function success_delete_alert()
   {
   	$("#alert_msg").html("<div class='alert alert-danger alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Data Deleted Succcessfully </div>");
   }
   function fail_delete_alert()
   {
   	$("#alert_msg").html("<div class='alert alert-warning alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Cannot delete the Data. Data is in use. </div>");
   }
</script>
<?php
  if(isset($_POST['operation'])){
    $operation=$_POST['operation'];
    if($operation=="bsearch")
    {
      $res=$objLms->searchBook($_POST['input']);
    }
  }
?>