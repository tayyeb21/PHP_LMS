<?php
include('../db/inc_db.php');
$operation=$_POST['operation'];

	if($operation=="input")
	{ ?>
		<form method="POST" onsubmit="return false;" autocomplete='on' >
			<table class="table table-bordered table-striped table-responsive">
			<tr>
				<td id="test">Student Name</td>
				<td><input type="text" name="stud_name" id="stud_name" placeholder="Enter The Student Name" class="form-control" required /> </td>
			</tr>
			<tr>
				<td>Student Father's Name</td>
				<td><input type="text" id="stud_father" name="stud_father" placeholder="Enter the Father name" class="form-control" required /> </td>
			</tr>
			<tr>
				<td>Date Of Birth</td>
				<td><input type="date" id="stud_dob" name="stud_dob" placeholder="Enter Date of Birth" class="form-control" required /></td>
			</tr>
			<tr>
				<td>Upload Photo</td>
				<td><input type="file" name="stud_photo" id="stud_photo" /></td>
			</tr>
			<tr>
				<td>Library Card Number</td>
				<td><input type="text" name="stud_lib_card_no" id="stud_lib_card_no" Placeholder="Enter Library Card Number" class="form-control" required /></td>
			</tr>
			<tr>
				<td>Class Name</td>
				<td><input type="hidden" id="stud_class_id" name="stud_class_id" />
				<input type="text" name="stud_class" id="stud_class" placeholder="Search Class Name" onKeyUp="search_class();" autocomplete='off' class="form-control"  required />
				<div id="search_result">
				</div>
				</td>
			</tr>
			<tr>
				<td>Semester</td>
				<td><select id="stud_sem" name="stud_sem" class="form-control">
				<option value="">---Select---</option>
				<option value="Ist Semester">Ist Semester</option>
				<option value="IInd Semester">IInd Semester</option>
				<option value="IIIrd Semester">IIIrd Semester</option>
				<option value="IVth Semester">IVth Semester</option>
				<option value="Vth Semester">Vth Semester</option>
				<option value="VIth Semester">VIth Semester</option></td>
			</tr>
			<tr>
				<td>Year</td>
				<td><select id="stud_year" name="stud_year" class="form-control">
				<option value="">---Select---</option>
				<option value="Ist Year">Ist Year</option>
				<option value="IInd Year">IInd Year</option>
				<option value="IIIrd Year">IIIrd Year</option></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><Select id="stud_gender" name="stud_gender" class="form-control">
				<option value="">---Select---</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text" name="stud_mob" id="stud_mob" placeholder="Enter the Mobile Number" pattern="[0-9]{10}" maxlength="10" title="Enter Only Numbers" class="form-control" /></td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td><input type="email" name="stud_email" id="stud_email" placeholder="Enter the E-Mail" title="Enter Valid E-Mail" class="form-control" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><textarea class="form-control" name="stud_address" id="stud_address" rows="3"></textarea></td>
			</tr>
			<!-- <tr>
				<td>Fine Amount</td>
				<td><input type="number" name="stud_fine_amount" id="stud_fine_amount" placeholder="Enter Fine Amount" class="form-control" required /></td>
			</tr> -->
			<tr>
				<td></td>
				<td><button  value="Save" name="submit" id="submit" class="btn btn-primary" onClick="save_student();" type="button">Save</button>
				<button type="button"  name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
			</table>
		</form>
<?php
	}
	elseif($operation=="c")
	{
		
		/* working on Files */
		$stud_mob=$_POST['stud_mob'];
		$dirname="StudentsPhotos/".$stud_mob;
		if(!file_exists($dirname))
			$dir_exist = mkdir($dirname);


		$target_dir = $dirname."/";
		$target_file = $target_dir . basename($_FILES["stud_photo"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["stud_photo"]["tmp_name"]);
			if($check !== false) {
				// echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				// echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		/* if (file_exists($target_file)) {
			// echo "Sorry, file already exists.";
			$uploadOk = 0;
		} */
		// Check file size
		if ($_FILES["stud_photo"]["size"] > 500000) {
			// echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			// echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else 
		{
			if (move_uploaded_file($_FILES["stud_photo"]["tmp_name"], $target_file)) {
				// echo "The file ". basename( $_FILES["stud_photo"]["name"]). " has been uploaded.";
			} else {
				// echo "Sorry, there was an error uploading your file.";
			}
		}

		/*----------------------------------------------*/
		$stud_name=strtolower(trim($_POST['stud_name']));
		$stud_father=strtolower(trim($_POST['stud_father']));
		$stud_dob=$_POST['stud_dob'];
		$stud_lib_card_no=$_POST['stud_lib_card_no'];
		$stud_photo = $target_file;
		$class_id=$_POST['stud_class_id'];
		$stud_sem=$_POST['stud_sem'];
		$stud_year=$_POST['stud_year'];
		$stud_gender=$_POST['stud_gender'];
		$stud_mob=$_POST['stud_mob'];
		$stud_email=$_POST['stud_email'];
		$stud_address=$_POST['stud_address'];
		// $stud_fine_amount=$_POST['stud_fine_amount'];
		$stud_dob=strtotime($stud_dob);
		$stud_dob=date('Ymdhis',$stud_dob);
		$res=$objLms->saveStudent($stud_name,$stud_father,$stud_dob,$stud_photo,$stud_lib_card_no,$class_id,$stud_sem,$stud_year,$stud_gender,$stud_mob,$stud_email,$stud_address/* ,$stud_fine_amount */);
		echo $res;
	}
	elseif($operation=="search")
	{
		$stud_class=$_POST['stud_class'];
		$res=$objLms->searchClass($stud_class);
	}
	elseif($operation=="r")
	{
		$objLms->showStudent1();
	}
	elseif($operation=="r1")
	{
		$objLms->showStudent2($_POST['id']);
	}
	elseif($operation=="r2")
	{
		$objLms->showStudent3($_POST['class_id'],$_POST['stud_sem'],$_POST['stud_year']);
	}
	elseif($operation=='r3')
	{
		$objLms->showStudent($_POST['stud_id']);
	}
	elseif($operation=="e")
	{
		$stud_id=$_POST['stud_id'];
		$res=$objLms->editStudent($stud_id);
	}
	elseif($operation=="u")
	{
		/* working on Files */
		$stud_mob=$_POST['stud_mob'];
		$dirname="StudentsPhotos/".$stud_mob;
		if(!file_exists($dirname))
			$dir_exist = mkdir($dirname);


		$target_dir = $dirname."/";
		$target_file = $target_dir . basename($_FILES["stud_photo"]["name"]);

		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["stud_photo"]["tmp_name"]);
			if($check !== false) {
				// echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				// echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		/* if (file_exists($target_file)) {
			// echo "Sorry, file already exists.";
			$uploadOk = 0;
		} */
		// Check file size
		if ($_FILES["stud_photo"]["size"] > 500000) {
			// echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			// echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else 
		{
			if (move_uploaded_file($_FILES["stud_photo"]["tmp_name"], $target_file)) {
				// echo "The file ". basename( $_FILES["stud_photo"]["name"]). " has been uploaded.";
			} else {
				// echo "Sorry, there was an error uploading your file.";
			}
		}
		$stud_id=$_POST['stud_id'];
		$stud_name=strtolower(trim($_POST['stud_name']));
		$stud_father=strtolower(trim($_POST['stud_father']));
		$stud_dob=$_POST['stud_dob'];
		$stud_photo=$target_file;
		$stud_lib_card_no=$_POST['stud_lib_card_no'];
		$class_id=$_POST['stud_class_id'];
		$stud_sem=$_POST['stud_sem'];
		$stud_year=$_POST['stud_year'];
		$stud_gender=$_POST['stud_gender'];
		$stud_mob=$_POST['stud_mob'];
		$stud_email=$_POST['stud_email'];
		$stud_address=$_POST['stud_address'];
		// $stud_fine_amount=$_POST['stud_fine_amount'];
		$stud_dob=strtotime($stud_dob);
		$stud_dob=date('Ymdhis',$stud_dob);
		$res=$objLms->updatestudent($stud_id,$stud_name,$stud_father,$stud_dob,$stud_photo,$stud_lib_card_no,$class_id,$stud_sem,$stud_year,$stud_gender,$stud_mob,$stud_email,$stud_address/*,stud_fine_amount*/);
		echo $res;
	}
	elseif($operation=="d")
	{
		$stud_id=$_POST['id'];
		$res=$objLms->deleteStudent($stud_id);
		echo $res;
	}