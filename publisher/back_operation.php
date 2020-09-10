<?php
include('../db/inc_db.php');
$operation=$_POST['operation'];


if($operation=="input")
{
?>
	<form type="POST" onsubmit="return false">
	<table class="table table-bordered table-striped">
		<tr>
			<td>Publisher Name </td>
			<td><input type="text" id="pub_name" name="pub_name" placeholder="Enter The Publisher Name" class="form-control" required /></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" id="save" value="Save" class="btn btn-primary" onClick="save_publisher();" />
		<input type="button" id="cancel" value="Clear" class="btn btn-danger" onClick="load_input_table();" /></td>
		</tr>
	</table>
	</form>
	<?php
}
else
if($operation=="c")
{
	$pub_name=$_POST['pub_name'];
	$result=$objLms->addPublisher($pub_name);
	echo $result;
}
else
if($operation=="r")
{

	$result=$objLms->showPublisher();
	//echo $result;
}
else
if($operation=="e")
{
	$pub_id=$_POST['id'];
	$res=$objLms->editPublisher($pub_id);
	echo $res;
}
else
if($operation=="d")
{
	$pub_id=$_POST['id'];
	$res=$objLms->deletePublisher($pub_id);
	echo $res;
}
else
	if($operation=="u")
	{
		$pub_id=$_POST['pub_id'];
		$pub_name=$_POST['edit_pub_name'];
		$res=$objLms->updatePublisher($pub_id,$pub_name);
		echo $res;
	}
?>