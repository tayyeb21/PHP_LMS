<?php 
$page='author';
include("../header_include_inner.php");
?>
 
<script>
function save_author()
{
	var author_name=$('#author_name').val();
	var form = $('form')[0];
	var formData = new FormData(form);
	formData.append('operation', 'c');
	if(author_name=="")
	{
		$("#warningModal").modal();
	}
	else
	{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data: formData,
			contentType: false,
			processData: false,
			success:function(response)
			{
				// alert(response);
				if(response==1)
				{
					// alert("Successfully Data Inerted");
					success_insert_alert();
					$("#myModal").modal("hide");
					
					load_data();
					load_input_table();
					
				}
				else
				{
					alert("failed to Insert Data");
				}
			}
		});
}
}
function edit_author(id)
{
	$.ajax({
	type:"POST",
	url:"back_operation.php",
	data:{id:id,operation:'e'},
	success:function(response)
	{
		// alert(response);
		$("#modal-body").html(response);
	}
	});	
}
function update_author()
{
	// var auth_id=$("#edit_auth_id").val();
	var auth_name=$("#edit_auth_name").val();
	var form = $('#update_auth_frm')[0];
	var formData = new FormData(form);
	formData.append('operation','u');

	if(auth_name=="")
	{
		$("#warningModal").modal();
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "back_operation.php",
			// data:{id:auth_id, auth_name:auth_name, operation:"u"},
			data: formData,
			contentType: false,
			processData: false,
			success: function(response)
			{
				// alert(response);
				if(response==1)
				{
					// alert("Successfully Data Updated");
					success_update_alert();
					$("#myModal").modal("hide");
					load_data();
				}
				else
				{
					// alert("failed to Update The Data!!");
					fail_update_alert();

				}
			}
		});	
}
}
function delete_author(auth_id)
{
	$("#confirmModal").modal();
	var wish = confirm("Do you really want to delete Data");
	if(wish){
	  $.ajax({
		type:"POST",
		url:"back_operation.php",
		data:{auth_id:auth_id,operation:"d"},
		success:function(response)
		{
			alert(response);
			if(response==1)
			{
				// alert("Successfully data Deleted");
				success_delete_alert();
				load_data();
				
			}
			else
			{
				// alert("Failed to Delete Data");
				fail_delete_alert();
			}
		}
	});
	}
		
}
function delete_data(){
	alert('hi');
}
</script>