	<?php
		$page="book";
		include('../header_include_inner.php');
	?>
	
<script>
	function save_book()
	{
		var book_name=$("#book_name").val();
		var auth_id=$("#auth_id").val();
		var pub_id=$("#pub_id").val();
		var book_price=$("#book_price").val();
		var book_pages=$("#book_pages").val();
		var book_code=$("#book_code").val();
		var book_language=$("#book_language").val();
		var no_of_books=$("#no_of_books").val(); 
		//alert(book_name);
		if(book_name==""&&auth_id==""&&pub_id==""&&book_price==""&&book_pages==""&&book_code==""&&book_language=="---Select---"&&no_of_books=="")
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
			// data:{book_name:book_name,auth_id:auth_id,pub_id:pub_id,book_price:book_price,book_pages:book_pages,book_code:book_code,book_language:book_language,no_of_books:no_of_books,operation:"c"},
			data: formData,
			contentType: false,
			processData: false,
			success:function(response)
			{
				//alert(response);
				if(response==1)
				{
					success_insert_alert();
					// load_input_table();
					$("#myModal").modal('hide');
					load_data();
				}
				else
				{
					// alert("Failed to Insert data");
					fail_insert_alert();
					$('#myModal').modal('hide');
				}
			}
		});
		}
	}
	function search_author()
	{
		var auth_name=$("#auth_name").val();
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{auth_name:auth_name,operation:"search0"},
			success:function(response)
			{
				$("#author_result").html(response);
			}
		});
	}	
	function search_publisher()
	{
		var pub_name=$("#pub_name").val();
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{pub_name:pub_name,operation:"search1"},
			success:function(response)
			{
				$("#publisher_result").html(response);
			}
		});
	}
	function select_author(auth_id,auth_name)
	{
		$('#auth_id').val(auth_id);
		$("#auth_name").val(auth_name);
		$("#author_result").html("");
	}
	function select_publisher(pub_id,pub_name)
	{
		$("#pub_id").val(pub_id);
		$("#pub_name").val(pub_name);
		$("#publisher_result").html("");
	}
	function edit_book(id)
	{
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			data:{book_id:id,operation:"e"},
			success:function(response)
			{
				//alert(response);
				$('#modal-body').html(response);
			}
		});
	}
		function update_book(id)
		{
		var book_name=$("#book_name").val();
		var auth_id=$("#auth_id").val();
		var pub_id=$("#pub_id").val();
		var book_price=$("#book_price").val();
		var book_pages=$("#book_pages").val();
		var book_code=$("#book_code").val();
		var book_language=$("#book_language").val();
		var no_of_books=$("#no_of_books").val(); 
		alert(book_name);
		if(book_name==""&&auth_id==""&&pub_id==""&&book_price==""&&book_pages==""&&book_code==""&&book_language=="---Select---"&&no_of_books=="")
		{
			$('#warningModal').modal();
		}
		var book_id = id;
		var form = $('#update_book_frm')[0];
		var formData = new FormData(form);
		formData.append('operation','u');
		formData.append('book_id',book_id);
		$.ajax({
			type:"POST",
			url:"back_operation.php",
			// data:{id:id,book_name:book_name,auth_id:auth_id,pub_id:pub_id,book_price:book_price,book_pages:book_pages,book_code:book_code,book_language:book_language,no_of_books:no_of_books,operation:"u"},
			data: formData,
			contentType: false,
			processData: false,
			success:function(response)
			{
				// alert(response);
				if(response==1)
				{
					// alert("Data Updated Successfully");
					success_update_alert(); 
					$("#myModal").modal("hide");
					load_data();
				}
				else
				{
					// alert("Failed to Update Data");
					fail_update_alert();
				}
			}
		});
		}
		function delete_book(id)
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
						failed_delete_alert();
					}
				}
			}); 
			}/* if statement end */
		}
		
</script>