<?php
include("../db/inc_db.php");
$operation = $_POST['operation'];
if($operation=='input')
{
?>
<form type="POST" onsubmit="return false">
<table class="table table-bordered table-hover table-striped">
			<tr>
				<td>User Name <span style="color:red"> *</span> </td>
				<td><input type="text" id="user_name" name="user_name" placeholder="User Name" class="form-control" title="This Is Required field"  required /></td><!-- onKeyUp="changeUpper(id);" -->
			</tr>
			<tr>
				<td>User Password <span style="color:red"> *</span> </td>
				<td><input type="password" id="user_pswd" name="user_pswd" placeholder="User Password" class="form-control" title="This Is Required field"  required /></td>
			</tr>
			<tr>
				<td>User Full Name <span style="color:red"> *</span> </td>
				<td><input type="text" id="user_fname" name="user_fname" placeholder="User Full Name" class="form-control" title="This Is Required field"  required /></td>
			</tr>
			<tr>
				<td> User Type </td>
				<td><select id="user_type" name="user_type" class="form-control" required>
				<option value="">---SELECT---</option>
				<option value="Administrator">Administrator</option>
				<option value="User">User</option></td>
				</select>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="save_data();">Save</button>
					<button type="reset" id="reset" name="reset" class="btn btn-danger" >Reset</button>
				</td>
			</tr>
		</table>
		</form>
<?php
}
else
if($operation=='c')
{
	//access the html values in php variable
	$user_name =  strtolower($_POST['user_name']);
	$user_fname =  strtolower($_POST['user_fname']);
	$user_pswd =  $_POST['user_pswd'];
	$user_type =  strtoLower($_POST['user_type']);

	$result = $objLms->addUser($user_name, $user_fname, $user_pswd, $user_type);

	echo $result;
}
else
if($operation=='r')
{
	//select query
	$res=$objLms->showUsers();
	echo $res;
}
else
if($operation=='d')
{
	$id = $_POST['id'];
	$res = $objLms->deleteUser($id);
	echo $res;
}
else
if($operation=='e')
{
	$id = $_POST['id'];
	$objLms->editUser($id);
}
else
if($operation=='u')
{
	$user_id = $_POST['user_id'];
	$user_name =  strtolower($_POST['user_name']);
	$user_fname =  strtolower($_POST['user_fname']);
	$user_pswd =  $_POST['user_pswd'];
	$user_type = strtolower($_POST['user_type']);	
	$res = $objLms->updateUser($user_id, $user_name, $user_fname, $user_pswd, $user_type);
	echo $res;
}
?>