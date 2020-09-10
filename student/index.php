	<?php
		$page="student";
		include('../header_include_inner.php');
	?>

<script>
	function save_student()
	{
		var stud_name=$("#stud_name").val();
		var stud_father=$("#stud_father").val();
		var stud_dob=$("#stud_dob").val();
		// alert(stud_dob);	
		//var stud_photo=$("#stud_photo").val();
		var stud_lib_card_no=$("#stud_lib_card_no").val();
		var stud_class_id=$("#stud_class_id").val();
		var stud_sem=$("#stud_sem").val();
		var stud_year=$("#stud_year").val();
		var stud_gender=$("#stud_gender").val();
		var stud_mob=$("#stud_mob").val();
		// var stud_fine_amount=$("#stud_fine_amount").val();
		//alert(stud_name);
		if(stud_name==""&&stud_father==""/* &&stud_dob=="" */&&stud_lib_card_no==""&&stud_class_id==""&&stud_sem==""&&stud_year==""&&stud_gender==""&&stud_mob=="")
		{
			$("#warningModal").modal();
		}
		else{
			var form = $('form')[0];
			var formData = new FormData(form);
			formData.append('operation','c');
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				// data:{stud_name:stud_name,stud_father:stud_father,stud_dob:stud_dob,/*stud_photo:stud_photo,*/stud_lib_card_no:stud_lib_card_no,stud_class_id:stud_class_id,stud_sem:stud_sem,stud_year:stud_year,stud_gender:stud_gender,stud_mob:stud_mob/*,stud_fine_amount:stud_fine_amount*/,operation:"c"},
				data: formData,
				contentType: false,
				processData: false,
				success:function(response)
				{
					// alert(response);
					if(response==1)
					{
						//alert("Successfully Data Inserted");
						//$("#success_msg").html("<div class='alert alert-success alert-dismissible'><a href='#' class='close' aria-label='close' data-dismiss='alert'>&times;</a>Successfully Data Inserted </div>");
						success_insert_alert();
						$("#myModal").modal('hide');
						// load_input_table();
						load_data();
					}
					else
					{
						alert(response);
						fail_insert_alert();
					}
				}
			});
			}
		}
	function search_class()
	{
		var stud_class=$("#stud_class").val();
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{stud_class:stud_class,operation:"search"},
			success:function(response)
			{
				$("#search_result").html(response);
			}
		});
	}
	function select_class(class_id,class_name)
	{
		$('#stud_class_id').val(class_id);
		$("#stud_class").val(class_name);
		$("#search_result").html("");
	}
	function edit_student(id)
	{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{stud_id:id,operation:"e"},
			success:function(response)
			{
				$('#modal-body').html(response);
			}
		});
	}
		function update_student(id)
		{
		var stud_name=$("#stud_name").val();
		var stud_father=$("#stud_father").val();
		var stud_dob=$("#stud_dob").val();
		//var stud_photo=$("#stud_photo").val();
		var stud_lib_card_no=$("#stud_lib_card_no").val();
		var stud_class_id=$("#stud_class_id").val();
		var stud_sem=$("#stud_sem").val();
		var stud_year=$("#stud_year").val();
		var stud_gender=$("#stud_gender").val();
		var stud_mob=$("#stud_mob").val();
		// var stud_fine_amount=$("#stud_fine_amount").val();
		//alert(stud_name);
		if(stud_name==""&&stud_father==""&&stud_dob==""&&stud_lib_card_no==""&&stud_class_id==""&&stud_sem==""&&stud_year==""&&stud_gender==""&&stud_mob=="")
		{
			$("#warningModal").modal();
		}
		else{
			var form = $('#update_stud_frm')[0];
			var formData = new FormData(form);	
			formData.append('operation','u');
			formData.append('stud_id',id);
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				// data:{id:id,stud_name:stud_name,stud_father:stud_father,stud_dob:stud_dob,/*stud_photo:stud_photo,*/stud_lib_card_no:stud_lib_card_no,stud_class_id:stud_class_id,stud_sem:stud_sem,stud_year:stud_year,stud_gender:stud_gender,stud_mob:stud_mob,/*stud_fine_amount:stud_fine_amount,*/operation:"u"},
				data: formData,
				contentType: false,
				processData: false,
				success:function(response)
				{
					// alert(response);
					if(response==1)
					{
						// alert("Data Updated Successfully");
						// $("#alert_msg").html("<div class='alert alert-info alert-dismissible'><a href='#' class='close' data-dismiss='alert'>&times;</a>Updated Data Succcessfully </div>");
						success_update_alert();
						$("#myModal").modal("hide");
						load_data();
						load_input_table();
					}
					else
					{
						//alert("Failed to Update Data");
						fail_update_alert(response);
					}
				}
			});
			}
	}
		function delete_student(id)
		{
			var wish=confirm("Do You Really Want To Delete Data");
			if(wish){
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				data:{id:id,operation:"d"},
				success:function(response)
				{
					// alert(response)
					if(response==1)
					{
						//alert("Data deleted Successfully");
						// $("#alert_msg").html("<div class='alert alert-danger alert-dismissible fade in'><a class='close' href='#' data-dismiss='alert' aria-label='close'>&times;</a>Data deleted Successfully</div>");
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
		function showSem(id)
		{
			$.ajax({
				type: "POST",
				url:"back_operation.php",
				data:{id:id,operation:"r1"},
				success:function(response)
				{
					// alert(response)
					/* if(response==null)
					{
						$("#content").html("No records Found");
					}
					else{ */
						$("#content").html(response);
					// }
				}
			});
		}
		function showStudList(id,sem,year)
		{
			$.ajax({
				type: "POST",
				url:"back_operation.php",
				data:{class_id:id,stud_sem:sem,stud_year:year,operation:"r2"},
				success:function(response)
				{
					// alert(response)
					/* if(response==null)
					{
						$("#content").html("No records Found");
					}
					else{ */
						$("#content").html(response);
					// }
				}
			});
		}
		function showStud(id)
		{
			$.ajax({
				type: "POST",
				url:"back_operation.php",
				data:{stud_id:id,operation:"r3"},
				success:function(response)
				{
					// alert(response)
					/* if(response==null)
					{
						$("#content").html("No records Found");
					}
					else{ */
						$("#content").html(response);
					// }
				}
			});
		}
</script>