	<?php
		$page="class";
		include('../header_include_inner.php');
	?>
	
<script>
	function save_class()
	{
		var form = $('form')[0];
		var formData = new FormData(form);
		formData.append('operation','c');
		var class_name=$("#class_name").val();
		var class_name = class_name.trim();
		if(class_name=="")
		{
			$('#warningModal').modal();
		}
		else{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data: formData,
			contentType: false,
			processData: false,
			success:function(response){
				if(response==1)
				{
					// alert("Successfully Data Inserted");
					success_insert_alert();
				    $('#myModal').modal('hide');
					load_data();
				}
				else
				{
					// alert("Failed to Insert Data");
					fail_insert_alert();
				}
				
			}
		});
	}
	}
function update_class(id)
{	
		var form = $('#update_class_frm')[0];
		var formData = new FormData(form);
		formData.append('operation','u');
		formData.append('class_id',id);
		/* var id=$("#edit_class_id").val(); */
		var class_name=$("#class_name").val();
		if(class_name=="")
		{
			$('#warningModal').modal();
		}
		else {
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data: formData,
			// data:{id:id,class_name:class_name,operation:"u"},
			contentType: false,
			processData: false,
			success:function(response){
				//alert(response);
				if(response==1)
				{
					// alert("Successfully Data updated");
					success_update_alert();
					$("#myModal").modal('hide');
					load_data();
					
				}
				else
				{
					alert("Failed to Insert Data");
				}
				
			}
		});
		}
}
function delete_class(id)
{
	var wish = confirm("Do you Really want to delete Data ?");
	if(wish){
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{id:id,operation:"d"},
			success:function(response){
				if(response==1)
				{
					success_delete_alert();
					load_data();
				}
				else
				{
					fail_delete_data();
				}
				
			}
		});
}
}

function edit_class(id)
{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{id:id,operation:"e"},
			success:function(response)
			{
				$("#modal-body").html(response);
			}
		});
}
function delete_class(id)
{
	var wish=confirm("Do You Really Want to Delete?");
	if(wish){
	$.ajax({
		type:"POST",
		url:"back_operation.php",
		data:{id:id,operation:"d"},
		success:function(response)
		{
		// alert(response);
		if(response==1)
		{
			// alert("Data Deleted Successfully");
			success_delete_alert();
			load_data();
		}
		else{
			fail_delete_alert();
			alert("Failed To Delete Data");
		}
	}
		});
}
}
</script>