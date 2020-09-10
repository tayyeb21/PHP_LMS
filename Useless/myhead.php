<html>
<head>
<?php
include('../db/inc_db.php');
include('../session_checker_inner.php');
include('../inner_linking_files.php');
include('../header_include_inner.php');
include('../left_navigation_include_inner.php');

?>
<!--
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" /> 
<link href="../assets/css/dashboard.css" rel="stylesheet" />
<script	src="../assets/js/jquery.3.2.1.min.js"></script>
<script	src="../assets/js/jquery.1.11.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
-->
<title>Registration</title>
</head>
<body style="margin:110px;">

<!--<div id="input_div" class="table table-responsive"> Input will load here </div> -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Student</h4>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<div id="content" class="table table-responsive"> Content will load here </div>
</div>
</div>
</div>
</div>

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
function load_data()
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
}
</script>
</body>
</html>


