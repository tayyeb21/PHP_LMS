<?php
$page="user";
// include('../user_type_checker.php');
include('../header_include_inner.php');
?>

<script>

function save_data()
{
	// var user_name = $("#user_name").val();
	// var user_pswd = $("#user_pswd").val();
	// var user_fname = $("#user_fname").val();
	// var user_type = $("#user_type").val();
	if($("#user_name").val()!="" && $("#user_fname").val()!="" && $("#user_pswd").val()!="")
	{
		var form = $('form')[0];
		var formData = new FormData(form);
		formData.append('operation','c');
		$.ajax({
			type:"POST", 	//GET or POST
			url:"back_operation.php", 
			// data:{user_name:user_name, user_fname:user_fname,user_pswd:user_pswd, user_type:user_type,operation:"create"},
			data: formData,
			contentType: false,
			processData: false,
			success:function(response)
			{
				// alert(response);
				if(response==1)
				{
					success_insert_alert();				
					//reload the div
					$("#myModal").modal('hide');
					load_data();
				}
				else{	
					fail_insert_alert();
			}
		}
		});
	}
	else
	{
		// $("#alertDiv").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please fill all the fields.</strong></div>');
		// $("#user_name").focus();
		$("#warningModal").modal();
	}
}
function edit_data(id)
{
	$.ajax({
		type:"POST",
		url:"back_operation.php",
		data:{id:id,operation:"e"},
		success:function(response)
		{
			//alert(response);
			$("#modal-body").html(response);
			// $("#edit_user_name").keyup(function(){
				// changeUpper('edit_user_name');
			// });
		}
	});
}
function update_data(id)
{
	/* var user_name = $("#user_name").val();
	var user_pswd = $("#user_pswd").val();
	var user_fname = $("#user_fname").val();
	var edit_id = $("#edit_id").val(); */
	if($("#user_name").val()!="" && $("#user_fname").val()!="" && $("#user_pswd").val()!="")
	{
		var form = $('form')[0];
		var formData= new FormData(form);
		formData.append('operation','u');
		formData.append('user_id',id);
		$.ajax({
			type:"POST", 	//GET or POST
			url:"back_operation.php", 
			// data:{user_name:user_name, user_fname:user_fname,user_pswd:user_pswd, user_type:user_type,operation:"create"},
			data: formData,
			contentType: false,
			processData: false,
			success:function(response)
			{
				//alert(response);
				if(response==1)
				{
					success_update_alert();				
					//reload the div
					$("#myModal").modal('hide');
					load_data();
				}
				else{
					fail_update_alert();
			}
		}
		});
		}
	else
	{
		// $("#alert_msg").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please fill all the fields.</strong></div>');
		$("#warningModal").modal();
		// ("#user_name").focus();
	}
}
function delete_data(id)
{
var wish=confirm("Do You Really Want To Delete Data?");
	if(wish)
	{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{id:id,operation:'d'},
			success:function(response)
			{
				if(response==1)
				{
					success_delete_alert();
					load_data();
				}
				else
				{
					fail_delete_alert();
				}
			}  //success function end....
		}); //ajax end......
	} 
}	
function changeUpper(me)
{
	$("#"+me).val($("#"+me).val().toUpperCase());
}
</script>