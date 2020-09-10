<?php
$page="issue";
include('../db/inc_db.php');
$operation=$_POST['operation'];

	if($operation=="input")
	{
		$today=date('d-m-Y');
		
?>
		<form method="POST" onsubmit="return false;">
			<table class="table table-bordered table-striped table-responsive">
			<tr>
				<td>Transaction date</td>
				<td>
				<input type="text" id="tr_date" name="tr_date" value="<?php echo $today; ?>" class="form-control" required disabled /> <button type="button" id="edit_attr" onClick="change();" class="btn btn-link"><span class="fa fa-pencil" title="Edit Date"></span> Edit</button></td> 
			</tr>
			<tr>
				<td>Particular</td>
				<td><textarea name="tr_particular" id="tr_particular" placeholder="Enter The Transaction Particular" class="form-control" cols="5" rows="4" required ></textarea> </td>
			</tr>
			
			<tr>
				<td>Amount</td>
				<td><input type="text" id="tr_amount" name="tr_amount" placeholder="Enter Amount" class="form-control" />
			</tr>
			<tr>
				<td>Type</td>
				<td><select id="tr_type" name="tr_type" class="form-control" required>
				<option value="---Select---">---Select---</option>
				<option value="1">Dr.</option>
				<option value="0">Cr.</option>
				</select> </td>
			</tr>
			<tr>
				<td></td>
				<td><button  value="Save" name="submit" id="submit" class="btn btn-primary" onClick="save_transact();">Save</button>
				<button type="button" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
			</table>
		</form>
<?php
	}
	elseif($operation=="c")
	{
		$tr_date=$_POST['tr_date'];
		$tr_particular=$_POST['tr_particular'];
		$tr_amount=$_POST['tr_amount'];
		$tr_type=$_POST['tr_type'];
		//formating the dates....
		$tr_date=strtotime($tr_date);
		$tr_date=date('Ymdhms',$tr_date);
		
		$res=$objLms->saveTransact($tr_date,$tr_particular,$tr_amount,$tr_type);
		echo $res;
	}
	elseif($operation=="r")
	{
		$objLms->showTransact();
	}
	elseif($operation=="e")
	{
		$tr_id=$_POST['id'];
		$res=$objLms->editTransact($tr_id);
	}
	elseif($operation=="u")
	{
		$tr_id=$_POST['tr_id'];
		$tr_date=$_POST['tr_date'];
		$tr_particular=$_POST['tr_particular'];
		$tr_amount=$_POST['tr_amount'];
		$tr_type=$_POST['tr_type'];
		//formating the dates....
		$tr_date=strtotime($tr_date);
		$tr_date=date('Ymdhms',$tr_date);
		
		$res=$objLms->updateTransact($tr_id,$tr_date,$tr_particular,$tr_amount,$tr_type);
		echo $res;
	}
	elseif($operation=='d')
	{
		$tr_id=$_POST['id'];
		$res=$objLms->deleteTransact($tr_id);
		echo $res;
	}
	