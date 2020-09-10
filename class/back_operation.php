<?php
include('../db/inc_db.php');
$operation=$_POST['operation'];


if($operation=="input")
{
?>
	<form id=add_class_frm>
	<table class="table table-bordered table-striped">
		<tr>
			<td>Class Name </td>
			<td><input type="text" id="class_name" name="class_name" placeholder="Enter The Class Name" class="form-control" /></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" id="save" value="Save" class="btn btn-primary" onClick="save_class();" />
		<input type="button" id="cancel" value="Clear" class="btn btn-danger" onClick="load_input_table();" /></td>
		</tr>
	</table>
	</form>
	<?php
}
else
if($operation=="c")
{
	$class_name=$_POST['class_name'];
	$result=$objLms->addClass($class_name);
	echo $result;
}
else
if($operation=="r")
{
	$result=$objLms->showClass();
}
else
if($operation=="e")
{
	$class_id=$_POST['id'];
	$res=$objLms->editClass($class_id);
	echo $res;
}
else
if($operation=="d")
{
	$class_id=$_POST['id'];
	$res=$objLms->deleteClass($class_id);
	echo $res;
}
else
	if($operation=="u")
	{
		$class_id=$_POST['class_id'];
		$class_name=$_POST['class_name'];
		$res=$objLms->updateClass($class_id,$class_name);
		echo $res;
	}
?>