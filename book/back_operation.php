<?php
include('../db/inc_db.php');
$operation=$_POST['operation'];

	if($operation=="input")
	{ ?>
		<form method="POST" onsubmit="return false;">
			<table class="table table-bordered table-striped">
			<tr>
				<td>Book Name</td>
				<td><input type="text" name="book_name" id="book_name" placeholder="Enter The Book Name" class="form-control" required /> </td>
			</tr>
			<tr>
				<td>Author Name</td>
				<td><input type="hidden" id="auth_id" name="auth_id" />
				<input type="text" id="auth_name" name="auth_name" placeholder="Search Author" class="form-control" onKeyUp="search_author();" required /> 
				<div id="author_result">
				</div></td>
			</tr>
			<tr>
				<td>Publisher Name</td>
				<td><input type="hidden" id="pub_id" name="pub_id" />
				<input type="text" id="pub_name" name="pub_name" placeholder="Search Publisher" class="form-control" onKeyUp="search_publisher();" required />
				<div id="publisher_result">
				</div></td>
			</tr>
			<tr>
				<td>Book Price</td>
				<td><input type="text" name="book_price" id="book_price" Placeholder="Enter the Book price" class="form-control" required /></td>
			</tr>
			<tr>
				<td>Book Pages</td>
				<td><input type="number" name="book_pages" id="book_pages" placeholder="Enter the Number Of Pages" class="form-control"  required /></td>
			</tr>
			<tr>
				<td>Book Code</td>
				<td><input type="text" name="book_code" id="book_code" placeholder="Enter Book Code" class="form-control" required /></td>
			</tr>
			<tr>
				<td>Book Language</td>
				<td><select id="book_language" name="book_language" class="form-control" required>
				<option value="---Select---">---Select---</option>
				<option value="English">English</option>
				<option value="Hindi">Hindi</option></td>
				</select> 
			</tr>
			<tr>
				<td>Books Available</td>
				<td><input type="number" id="no_of_books" name="no_of_books" placeholder="Enter Number Of Books" class="form-control" /></td>
			</tr>
			<tr>
				<td></td>
				<td><button  value="Save" name="submit" id="submit" class="btn btn-primary" onClick="save_book();" type="button">Save</button>
				<button type="button" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
			</table>
		</form>
<?php
	}
	elseif($operation=="c")
	{
		$book_name=$_POST['book_name'];
		$auth_id=$_POST['auth_id'];
		$pub_id=$_POST['pub_id'];
		$book_price=$_POST['book_price'];
		$book_pages=$_POST['book_pages'];
		$book_code=$_POST['book_code'];
		$book_language=$_POST['book_language'];
		$no_of_books=$_POST['no_of_books'];
		$res=$objLms->saveBook($book_name,$auth_id,$pub_id,$book_price,$book_pages,$book_code,$book_language,$no_of_books);
		echo $res;
	}
	elseif($operation=="search0")
	{
		$auth_name=$_POST['auth_name'];
		$res=$objLms->searchAuthor($auth_name);
	}
	elseif($operation=="search1")
	{
		$pub_name=$_POST['pub_name'];
		$res=$objLms->searchPublisher($pub_name);
	}
	elseif($operation=="r")
	{
		$objLms->showBook();
	}
	elseif($operation=="e")
	{
		$book_id=$_POST['book_id'];
		$res=$objLms->editBook($book_id);
	}
	elseif($operation=="u")
	{
		$book_id=$_POST['book_id'];
		$book_name=$_POST['book_name'];
		$auth_id=$_POST['auth_id'];
		$pub_id=$_POST['pub_id'];
		$book_price=$_POST['book_price'];
		$book_pages=$_POST['book_pages'];
		$book_code=$_POST['book_code'];
		$book_language=$_POST['book_language'];
		$no_of_books=$_POST['no_of_books'];
		$res=$objLms->updateBook($book_id,$book_name,$auth_id,$pub_id,$book_price,$book_pages,$book_code,$book_language,$no_of_books);
		echo $res;
	}
	elseif($operation=='d')
	{
		$book_id=$_POST['id'];
		$res=$objLms->deleteBook($book_id);
		echo $res;
	}