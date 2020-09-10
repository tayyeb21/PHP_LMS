<?php
$page="issue";
include('../db/inc_db.php');
$operation=$_POST['operation'];

	if($operation=="input")
	{
		$today=date("d-m-Y");
		$next=date_create($today);
		$next=date_add($next,date_interval_create_from_date_string('15 days'));
		$next=date_format($next,'d-m-Y');
?>
		<form method="POST" onsubmit="return false;">
			<table class="table table-bordered table-striped">
			<tr>
				<td>Student Card No</td>
				<td><input type="hidden" id="stud_id" name="stud_id" />
				<input type="text" id="stud_detail" name="stud_detail" placeholder="Search Student" onKeyUp="search_student();" class="form-control" required /> 
				<div id="student_result">
				</div></td>
			</tr>
			<tr>
				<td>Book Name</td>
				<td><input type="hidden" id="book_id" name="book_id" />
				<input type="text" id="book_detail" class="form-control" name="book_detail" placeholder="Search Book" onKeyUp="search_book();" required />
				<div id="book_result">
				</div></td>
			</tr>
			<tr>
				<td>Issue Date</td>
				<td><input type="text" id="issue_date" name="issue_date" value="<?php echo $today; ?>" class="form-control" disabled />
				<a href="#" id="edit_attr" href="#" onClick="change();" >Edit</a>
				<a href="#" id="ok_btn" href="#" onClick="add_time();" hidden>Ok</a></td>
			</tr>
			<tr>
				<td>Return Date</td>
				<td><input type="text" id="issue_return_date" name="issue_return_date" class="form-control" value="<?php echo $next; ?>" disabled />
				<a href="#" id="edit_date" href="#" onClick="change_return();" >Edit</a></td>
			</tr>
			<tr>
				<td>Returned Or Not</td>
				<td><select id="issue_returned_or_not" name="issue_returned_or_not" class="form-control" required>
				<option value="---Select---">---Select---</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
				</select> </td>
			</tr>
			<tr>
				<td>Fine Or Not</td>
				<td><select id="issue_fine_or_not" name="issue_fine_or_not" class="form-control" onChange="fine_amount_const();" required>
				<option value="">---Select---</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
				</select> </td>
			</tr>
			<tr>
				<td>Fine Amount</td>
				<td><input type="number" id="issue_fine" name="issue_fine" placeholder="Enter Fine Amount" class="form-control" value="0" disabled /></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="button" value="Save" name="submit" id="submit" class="btn btn-primary" onClick="save_issue();" type="button">Save</button>
				<button type="button" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
			</table>
		</form>
<?php
	}
	elseif($operation=="c")
	{
		$stud_id=$_POST['stud_id'];
		$book_id=$_POST['book_id'];
		$issue_date=$_POST['issue_date'];
		$issue_return_date=$_POST['issue_return_date'];
		$issue_returned_or_not=$_POST['issue_returned_or_not'];
		$issue_fine_or_not=$_POST['issue_fine_or_not'];
		$issue_fine=$_POST['issue_fine'];
		//formating the dates....
		$issue_date=strtotime($issue_date);
		$issue_date=date('Ymdhms',$issue_date);		
		$issue_return_date=strtotime($issue_return_date);
		$issue_return_date=date('Ymdhms',$issue_return_date);
		
		$res=$objLms->saveIssue($stud_id,$book_id,$issue_date,$issue_return_date,$issue_returned_or_not,$issue_fine_or_not,$issue_fine);
		echo $res;
	}
	elseif($operation=="search0")
	{
		$stud_detail=$_POST['stud_detail'];
		$res=$objLms->searchStudent($stud_detail);
	}
	elseif($operation=="search1")
	{
		$book_detail=$_POST['book_detail'];
		$res=$objLms->searchBook($book_detail);
	}
	elseif($operation=="r")
	{
		$objLms->showIssuedBook1();
	}
	elseif($operation=="e")
	{
		$issue_id=$_POST['id'];
		$res=$objLms->editIssue($issue_id);
	}
	elseif($operation=="u")
	{
		$issue_id=$_POST['issue_id'];
		$stud_id=$_POST['stud_id'];
		$book_id=$_POST['book_id'];
		$issue_date=$_POST['issue_date'];
		$issue_return_date=$_POST['issue_return_date'];
		$issue_returned_or_not=$_POST['issue_returned_or_not'];
		$issue_fine_or_not=$_POST['issue_fine_or_not'];
		$issue_fine=$_POST['issue_fine'];
		$res=$objLms->updateIssue($issue_id,$stud_id,$book_id,$issue_date,$issue_return_date,$issue_returned_or_not,$issue_fine_or_not,$issue_fine);
		echo $res;
	}
	elseif($operation=='d')
	{
		$issue_id=$_POST['id'];
		$res=$objLms->deleteIssue($issue_id);
		echo $res;
	}
	elseif($operation=="add_date")
	{
		$issue_date=$_POST['issue_date'];
		$issue_date=date_create($issue_date);
		$issue_return_date=date_add($issue_date,date_interval_create_from_date_string('15 days'));
		$issue_return_date=date_format($issue_return_date,'d-m-Y');
		echo $issue_return_date;
		
	}
	elseif($operation=="lib_search")
	{
		$data = $_POST["lib_no"]; 
		$objLms->libSearch($data);
	}
	elseif($operation=="show_stud_result")
	{
		$stud_id=$_POST['stud_id'];
		$objLms->showIssuedBook($stud_id);
	}