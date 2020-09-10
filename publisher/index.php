	<?php
		$page="publisher";
		include('../header_include_inner.php');
	?>

<script>
	function save_publisher()
	{
		// var pub_name=$("#pub_name").val();
		if($("#pub_name").val().trim()=="")
		{
			$('#warningModal').modal();
		}
		else{
			var form = $('form')[0];
			var formData = new FormData(form);
			formData.append('operation','c');
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				// data:{pub_name:pub_name,operation:"c"},
				data: formData,
				contentType: false,
				processData: false,
				success:function(response){
					// alert(response);
					if(response==1)
					{
						$('#myModal').modal('hide');
						success_insert_alert();
						load_data();
					}
					else
					{
						fail_insert_alert();
						// alert("Failed to Insert Data");
					}

				}
			});
		}
	}
function update_publisher(id)
{
	// var id=$("#edit_pub_id").val();
	// var edit_pub_name=$("#edit_pub_name").val();
	if($('#edit_pub_name').val().trim()=="")
	{
		$("#warningModal").modal();
	}
	else{
		var form = $('#update_pub_frm')[0];
		var formData = new FormData(form);
		formData.append('operation','u');
		formData.append('pub_id',id);
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			// data:{id:id,edit_pub_name:edit_pub_name,operation:"u"},
			data: formData,
			contentType: false,
			processData: false,
			success:function(response){
				//alert(response);
				if(response==1)
				{
					// alert("Successfully Data updated");
					success_update_alert();
					$('#myModal').modal('hide');
					load_data();
				}
				else
				{
					// alert("Failed to Insert Data");
					fail_update_alert();
				}

			}
		});
	}

}
function delete_publisher(id)
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
					// alert("Data Deleted Successfully");
					success_delete_alert();
					load_data();
				}
				else
				{
					fail_delete_alert();
					// alert("Failed to delete Data");
				}

			}
		});
}
}

function edit_publisher(id)
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


</script>