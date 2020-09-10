	<?php
		$page="transaction";
		// include('../user_typ	e_checker.php');
		include('../header_include_inner.php');
	?>
	
<script>
	function save_transact()
	{
		var tr_date=$("#tr_date").val();
		/* var tr_particular=$("#tr_particular").val();
		var tr_amount=$("#tr_amount").val();
		var tr_type=$("#tr_type").val(); */
		if($("#tr_date").val()==""&&$("#tr_particular").val()==""&&$("#tr_amount").val()==""&&$("#tr_type").val()=="")
		{
			$("#warningModal").modal();
		}
		else{
			var form = $("form")[0];
			var formData = new FormData(form);
			formData.append('operation','c');
			formData.append('tr_date',tr_date);
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				// data:{tr_date:tr_date,tr_particular:tr_particular,tr_amount,tr_type,operation:"c"},
				data: formData,
				contentType: false,
				processData: false,
				success:function(response)
				{
					alert(response);
					if(response==1)
					{
						success_insert_alert();
						$('#myModal').modal("hide");
						load_data();
					}
					else
					{
						fail_insert_alert();
						// alert("Failed to Insert data");
					}
				}
			});
		}	
	}
	function edit_transact(id)
	{
	$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{id:id,operation:"e"},
			success:function(response)
			{
				//alert(response);
				$("#modal-body").html(response);
			}
		});
		
	}
	function update_transact(id)
	{
		var tr_date=$("#tr_date").val();
		/* var tr_particular=$("#tr_particular").val();
		var tr_amount=$("#tr_amount").val();
		var tr_type=$("#tr_type").val(); */
		if($("#tr_date").val()==""&&$("#tr_particular").val()==""&&$("#tr_amount").val()==""&&$("#tr_type").val()=="")
		{
			$("#warningModal").modal();
		}
		else{
			var form = $("form")[0];
			var formData = new FormData(form);
			formData.append('operation','u');
			formData.append('tr_date',tr_date);
			formData.append('tr_id',id);
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				// data:{id:id,tr_date:tr_date,tr_particular:tr_particular,tr_amount,tr_type,operation:"u"},
				data:formData,
				contentType: false,
				processData: false,
				success:function(response)
				{
					//alert(response);
					if(response==1)
					{
						// alert("Data Updated Successfully");
						success_update_alert();
						$('#myModal').modal('hide');
						load_data();
					}
					else
					{
						fail_update_alert();
						// alert("Failed to Update data");
					}
				}
			});
		}		
	}
	function delete_transact(id)
	{
		var wish=confirm("Do You Really Want to Delete");
		if(wish)
		{
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				data:{id:id,operation:"d"},
				success:function(res)
				{
					// alert(res);
					if(res==1)
					{
						// alert("Data Deleted Successfully");
						success_delete_alert();
						load_data();
					}
					else
					{
						fail_delete_alert();
						// alert("Failed to Delete Data");
					}
				}
			});				
	}
	}
	function change()
	{
		$("#tr_date").attr("disabled",false);
		$("#tr_date").attr("type","date");		
	}
	

</script>