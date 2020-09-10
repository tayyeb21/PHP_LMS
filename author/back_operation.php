<?php
include("../db/inc_db.php");
$operation = $_POST['operation'];
if($operation=='input')
{
?>
	<form>
	<table class="table table-bordered table-striped">
		<tr>
			<td>Author Name </td>
			<td><input type="text" id="author_name" name="author_name" placeholder="Enter The Author Name" class="form-control" /></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" id="save" value="Save" class="btn btn-primary" onClick="save_author();" />
		<input type="button" id="reset" name="reset" value="Clear" class="btn btn-danger" onclick="load_input_table();"/></td>
		</tr>
	</table>
	</form>
<?php
}
else
if($operation=='c')
{
	$author_name=$_POST['author_name'];
	$res=$objLms->saveAuthor($author_name);
	echo $res;
}
else
if($operation=='r')
{
	$objLms->showAuthors();
}
else
if($operation=='d')
{
	$auth_id=$_POST['auth_id'];
	$res=$objLms->deleteAuthor($auth_id);
	echo $res;
}
else
if($operation=='e')
{	
	$auth_id=$_POST['id'];
	$res=$objLms->editAuthor($auth_id);
	//echo $res;
}
else
if($operation=='u')
{
/* 	$auth_id=$_POST['id'];
	$auth_name=$_POST['auth_name']; */
	$auth_id=$_POST['edit_auth_id'];
	$auth_name=$_POST['edit_auth_name']; 
	$res=$objLms->updateAuthor($auth_id,$auth_name);
	echo $res;
}
?>