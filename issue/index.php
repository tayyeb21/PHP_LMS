<?php
		$page="issue";
		include('../header_include_inner.php');
	?>
	
<script>
	function save_issue()
	{
		var stud_id=$("#stud_id").val();
		var book_id=$("#book_id").val();
		var issue_date=$("#issue_date").val();
		var issue_return_date=$("#issue_return_date").val();
		var issue_returned_or_not=$("#issue_returned_or_not").val();
		var issue_fine_or_not=$("#issue_fine_or_not").val();
		var issue_fine=$("#issue_fine").val();
        //alert(book_name);
        if(stud_id!=""&&book_id!=""&&issue_date!=""&&issue_return_date!=""&&issue_fine!="")
        {
            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('operation','c');
            formData.append('issue_date',issue_date);
            formData.append('issue_return_date',issue_return_date);
            formData.append('issue_fine',issue_fine);
            $.ajax({
                type:"POST",
                url:"back_operation.php",
                // data:{stud_id:stud_id,book_id:book_id,issue_date:issue_date,issue_return_date:issue_return_date,issue_returned_or_not:issue_returned_or_not,issue_fine_or_not:issue_fine_or_not,issue_fine:issue_fine,operation:"c"},
                data: formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    //alert(response);
                    if(response==1)
                    {
                        // alert("Successfully Data Inserted");
                        success_insert_alert();
                        load_input_table();
                        load_data();
                    }
                    else
                    {
                        // alert("Failed to Insert data");
                        fail_insert_alert();
                    }
                }
            });
        }
        else{
            $("#warningModal").modal();
        }
    }
	function search_student()
	{
		var stud_detail=$("#stud_detail").val();
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{stud_detail:stud_detail,operation:"search0"},
			success:function(response)
			{
				$("#student_result").html(response);
			}
		});
	}	
	function search_book()
	{
		var book_detail=$("#book_detail").val();
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{book_detail:book_detail,operation:"search1"},
			success:function(response)
			{
				$("#book_result").html(response);
			}
		});
	}
	function select_student(stud_id,stud_detail)
	{
		$('#stud_id').val(stud_id);
		$("#stud_detail").val(stud_detail);
		$("#student_result").html("");
	}
	function select_book(book_id,book_name)
	{
		$("#book_id").val(book_id);
		$("#book_detail").val(book_name);
		$("#book_result").html("");
	}
	function edit_issue(id)
	{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{id:id,operation:"e"},
			success:function(response)
			{
				$('#modal-body').html(response);
			}
		});
	}
		function update_issue(id)
		{
            var stud_id=$("#stud_id").val();
            var book_id=$("#book_id").val();
            var issue_date=$("#issue_date").val();
            var issue_return_date=$("#issue_return_date").val();
            var issue_returned_or_not=$("#issue_returned_or_not").val();
            var issue_fine_or_not=$("#issue_fine_or_not").val();
            var issue_fine=$("#issue_fine").val();
            //alert(book_name);
            if(stud_id!=""&&book_id!=""&&issue_date!=""&&issue_return_date!=""&&issue_fine!="")
            {
                var form = $('form')[0];
                var formData = new FormData(form);
                formData.append('operation','u');
                formData.append('issue_id',id);
                formData.append('issue_date',issue_date);
                formData.append('issue_return_date',issue_return_date);
                formData.append('issue_fine',issue_fine);
                $.ajax({
                    type:"POST",
                    url:"back_operation.php",
                    // data:{id:id,stud_id:stud_id,book_id:book_id,issue_date:issue_date,issue_return_date:issue_return_date,issue_returned_or_not:issue_returned_or_not,issue_fine_or_not:issue_fine_or_not,issue_fine:issue_fine,operation:"u"},
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(response)
                    {
                        alert(response);
                        if(response==1)
                        {
                            // alert("Data Updated Successfully");
                            success_update_alert();
                            load_data();
                            load_input_table();
                        }
                        else
                        {
                            // alert("Failed to Update Data");
                            fail_update_alert();
                            load_input_table();
                        }
                    }
                });
            }
        }
		function delete_issue(id)
		{
			var wish=confirm("Do You Really Want To Delete The Record?");
			if(wish){
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				data:{id:id,operation:"d"},
				success:function(response)
				{
					//alert(response);
					if(response==1)
					{
						// alert("Data Deleted Successfully");
						success_delete_alert();
						load_data();
					}
					else
					{
						// alert("Failed to Delete data");
						fail_delete_alert();
					}
				}
			}); 
			}/* if statement end */
		}
		function change()
		{
			$("#issue_date").attr("disabled",false);
			$("#issue_date").attr("type","date");
			//$("#issue_return_date").attr("disabled",false);
			//$("#issue_return_date").attr("type","date");
			$("#edit_attr").attr("hidden",true);
			$("#ok_btn").attr("hidden",false);
		}
		function add_time()
		{
			var issue_date=$("#issue_date").val();
			$.ajax({
				type:"POST",
				url:"back_operation.php",
				data:{issue_date:issue_date,operation:"add_date"},
				success:function(res)
				{
					$("#issue_return_date").val(res);
					$("#issue_date").attr("disabled",true);
					$("#ok_btn").attr("hidden",true);
					$("#edit_attr").attr("hidden",false);
				}
			});
		}
		function change_return()
		{
			$("#issue_return_date").attr("disabled",false);
			$("#issue_return_date").attr("type","date");
        }			
        function fine_amount_const()
        {
            if($("#issue_fine_or_not").val()==1)
            {
                $("#issue_fine").attr("disabled",false);
            }
            else{
                $("#issue_fine").attr("disabled",true);
                $("#issue_fine").val("0");
            }
        }
        function lib_search()
        {
            var lib_no = $("#lib_search").val();
                $.ajax({
                    type:"POST",
                    url:"back_operation.php",
                    data:{lib_no:lib_no,operation:"lib_search"},
                    success:function(response)
                    {
                        // alert(response);
                        $("#lib_search_result").html(response);
                    }
                });
        }
        function select_student_result(id)
        {
            $.ajax({
                type:"POST",
                url:"back_operation.php",
                data:{stud_id:id,operation:"show_stud_result"},
                success:function(response)
                {
                    $("#content").html(response);
                }
            });
        }
</script>