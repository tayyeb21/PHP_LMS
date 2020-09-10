<?php
	define("HOST","127.0.0.1");
	define("USER","root");
	define("PSWD","");
	define("DATABASE","lms");

	  class connectionClass
	  {
		public $conn;
		public function ConnectionFun()
		{
	 		$this->conn = new mysqli(HOST,USER,PSWD,DATABASE);
	 		// return $conn;
		 }
		 public function __construct(){
			$this->ConnectionFun();
		}

	  }
	//starting of the class
	class clsLMS extends connectionClass
	{
		//collection of data members and member functions

		//member functions
		//constructor
		public $count=1;
		function __construct()
		{
			/* $con=mysqli_connect(HOST,USER,PSWD,DATABASE);
			$conn = new mysqli(HOST,USER,PSWD,DATABASE);	//connection function.
			mysql_select_db(DATABASE);		//select the database in which you want to work. */
			parent::__construct();
			session_start();
			
		}

		//destructor
		function __destruct(){}

		// public function ConnectionFun()
		// {
		// 	$conn = new mysqli(HOST,USER,PSWD,DATABASE);
		// 	return $conn;
		// }

		//login authentication

		function checkLogin($user_name, $pswd)
		{
			// $conn = $this->ConnectionFun();
			$sql="SELECT * FROM tbl_user WHERE user_name='$user_name' AND user_password='$pswd'";
			// $result = $conn->query($sql);
			$result = $this->conn->query($sql);
			// $resource=mysql_query($sql);
			if($result->num_rows>=1)
			{
				return $result;
			}
			else
			{
				// $res=0;
				return 0;
			}
			// $conn->close();

		}
		//authors defined member function
		function saveAuthor($authorName)
		{
			// $conn=$this->ConnectionFun();
			//query
			$sql = "INSERT INTO tbl_authors (auth_name) VALUES ('$authorName')";
			//execute the query
			return $result = $this->conn->query($sql);
		}

		//authors defined member function
		function editAuthor($id)
		{
			//select query..
			$sql="SELECT * from tbl_authors WHERE auth_id=".$id;
			//execute thedit_authore query
			$result = $this->conn->query($sql);

			while($row = $result->fetch_assoc())
			{
			?>
			<form id="update_auth_frm" enctype="formdata/multipart">
				<input type="hidden" id="edit_auth_id" name="edit_auth_id" value="<?php echo $row['auth_id']; ?>" />
				<table class="table table-bordered table-striped">
					<tr>
						<td>Author Name</td>
						<td><input type="text" id="edit_auth_name" name="edit_auth_name" value="<?php echo $row['auth_name']; ?>"  class="form-control" required /></td>
					</tr>

					<tr>
						<td></td>
						<td><input type="button" id="update" name="update" value="Update" class="btn btn-primary" onclick="update_author();"/>

						<input type="button" id="reset" name="reset" value="Cancel" class="btn btn-danger" onclick="load_input_table();"/></td>
					</tr>
				</table>
				</form>
				<?php
				}
		}

		//authors defined member function
		function updateAuthor($authorId, $authorName )
		{
			//select query..
			$sql="UPDATE tbl_authors SET auth_name='$authorName' WHERE auth_id=".$authorId;

			//execute the query
			return $result = $this->conn->query($sql);
		}

		//authors defined member function
		function deleteAuthor($authorId)
		{
			//select query..
			$sql="DELETE FROM tbl_authors WHERE auth_id=".$authorId;	
			//execute the query
			return $result = $this->conn->query($sql);
		}

		function showAuthors()
		{
		//select query..
		// $conn = $this->ConnectionFun();
		$sql="SELECT * from tbl_authors";

		//execute the query
		$result = $this->conn->query($sql);
		?>
		<table class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Sr.No</th>
				<th>Name</th>
				<th colspan="2">Operations</th>
			</tr>
			</thead>
			</tbody>
			<?php
				while($row = $result->fetch_assoc())
				{
					echo "<tr>
							<td>".$this->count++."</td>
							<td>".ucfirst($row['auth_name'])."</td>
							<td><a href='#' data-toggle='modal' data-target='#myModal' onClick='edit_author(".$row['auth_id'].");' ><span class='fa fa-pencil' title='Edit'></span></</a></td>
							<td><a href='#' onClick='delete_author(".$row['auth_id'].");'><span class='fa fa-trash' title='Delete'></span></a></td>
						</tr>";
				}
				// $conn->close();
			?>
			</tbody>
		</table>
		<div id="add_author" class="addbtn"><button type='button' id="toggle-button"  class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add Author</button></div>

		<?php
		}
		//for Dashboards Count
		function getAllBooksCount()
		{
			//select query.
			// $conn = $this->ConnectionFun();
			$sql="SELECT COUNT(*) as all_books from tbl_books";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc())
			{
				echo $row['all_books'];
			}
			// $conn->close();
		}
		function getAllAuthorsCount()
		{
			//select query..
			// $conn = $this->ConnectionFun();
			$sql="SELECT COUNT(*) as all_authors from tbl_authors";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc())
			{
				echo $row['all_authors'];
			}
			// $conn->close();
		}
		function getAllPublishersCount()
		{
			$sql="SELECT COUNT(*) as all_publishers from tbl_pub";
			$result=$this->conn->query($sql);
			$row=$result->fetch_assoc();
			echo $row['all_publishers'];
		}
		function getAllStudentCount()
		{
			$sql="SELECT COUNT(stud_name) AS stud_count FROM tbl_student";
			$result=$this->conn->query($sql);
			$row=$result->fetch_assoc();
			echo $row['stud_count'];
		}
		function getAllClassCount()
		{
			$sql="SELECT COUNT(class_name) AS class_count FROM tbl_class";
			$result=$this->conn->query($sql);
			$row=$result->fetch_assoc();
			echo $row['class_count'];
		}
		function getAllIssueCount()
		{
			$sql="SELECT COUNT(issue_id) AS issue_count from tbl_issue";
			$result=$this->conn->query($sql);
			$row=$result->fetch_assoc();
			echo $row['issue_count'];
		}

		/* Class Operations */
		function addClass($class_name)
		{
			$sql="INSERT INTO tbl_class(class_name)VALUES('$class_name')";
			return $result = $this->conn->query($sql);
		}
		function showClass()
		{
		$sql="SELECT * FROM tbl_class";
		$result = $this->conn->query($sql);
		?>
		<table class="table table-bordered table-striped ">
		<thead>
		<tr>
		<th>Sr.No</th>
		<th>Class Name</th>
		<th colspan="2">Operations</th>
		</tr>
		</thead>
		<tbody>
		<?php
			while($row=$result->fetch_assoc())
			{ ?>
				<tr>
				<td><?php echo $this->count++; ?></td>
				<td><?php echo $row['class_name']; ?></td>
				<td><a href="#" onClick="edit_class(<?php echo $row['class_id'];?>);" data-toggle='modal' data-target='#myModal'><span class='fa fa-pencil' title='Edit'></span></a></td>
				<td><a href="#" onClick="delete_class(<?php echo $row['class_id'];?>);"><span class='fa fa-trash' title='Delete'></span></a></td>
				</tr>
				<!--</table> -->
			<?php } ?>
			</tbody>
			</table>
			<div id="add_class" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add Class</button></div>
			<?php
		}
		function editClass($class_id)
		{
			$sql="SELECT * FROM tbl_class WHERE class_id=".$class_id;
			$result = $this->conn->query($sql);
			while($row=$result->fetch_assoc())
			{	?>
			<form id="update_class_frm">
			<table class="table table-bordered table-striped">
		<tr>
			<td>Class Name </td>
			<td><input type="text" id="class_name" name="class_name" value="<?php echo $row['class_name']; ?>" class="form-control" required /></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" id="update" value="Update" class="btn btn-primary" onClick="update_class('<?php echo $row['class_id']; ?>');" />
		<input type="button" id="cancel" value="cancel" class="btn btn-danger" onClick="load_input_table();" /></td>
		</tr>



	</table>
	</form>
	<?php
		}
	}
	function deleteClass($class_id)
	{
		$sql="DELETE FROM tbl_class WHERE class_id=".$class_id;
		return $result = $this->conn->query($sql);
	}
	function updateClass($class_id,$class_name)
	{
		$sql="UPDATE tbl_class SET class_name='$class_name' WHERE class_id=$class_id";
		return $result = $this->conn->query($sql);
	}


		/* Publishers */
/* 		function insert($tableName,$data){

		} */
		function addPublisher($pub_name)
		{
			$sql="INSERT INTO tbl_pub(pub_name)VALUES('$pub_name')";
			return $result = $this->conn->query($sql);
		}
		function showPublisher()
		{
		$sql="SELECT * FROM tbl_pub";
		$result=$this->conn->query($sql);
	?>
		<table class="table table-bordered table-striped ">
		<thead>
		<tr>
		<th>Sr.No</th>
		<th>Publisher Name</th>
		<th colspan="2">Operations</th>
		</tr>
		</thead>
		<tbody>
		<?php
			while($row=$result->fetch_assoc())
			{ ?>
				<tr>
				<td><?php echo $this->count++; ?></td>
				<td><?php echo ucfirst($row['pub_name']); ?></td>
				<td><a href="#" onClick="edit_publisher(<?php echo $row['pub_id'];?>);" data-toggle="modal" data-target="#myModal"><span class='fa fa-pencil' title='Edit'></span></a></td>
				<td><a href="#" onClick="delete_publisher(<?php echo $row['pub_id'];?>);"><span class='fa fa-trash' title='Delete'></span></a></td>
				</tr>
			<?php }	?>
			</tbody>
			</table>
			<div id="add_publisher" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add Publisher</button></div>
			<?php
		}
		function editPublisher($pub_id)
		{
			$sql="SELECT * FROM tbl_pub WHERE pub_id=".$pub_id;
			$result = $this->conn->query($sql);
			while($row=$result->fetch_assoc())
			{
			?>
			<form id="update_pub_frm">
			<!-- <input type="hidden" value="<?php echo $row['pub_id']; ?>" id="edit_pub_id" name="edit_pub_id" /> -->
			<table class="table table-bordered table-striped">
		<tr>
			<td>Publisher Name </td>
			<td><input type="text" id="edit_pub_name" name="edit_pub_name" value="<?php echo $row['pub_name']; ?>"  class="form-control" /></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" id="update" value="Update" class="btn btn-primary" onClick="update_publisher(<?php echo $pub_id; ?>);" />
		<input type="button" id="cancel" value="cancel" class="btn btn-danger" onClick="load_input_table();" /></td>
		</tr>



	</table>
	</form>
	<?php
		}
	}
	function deletePublisher($pub_id)
	{
		$sql="DELETE FROM tbl_pub WHERE pub_id=".$pub_id;
		return $result = $this->conn->query($sql);
	}
	function updatePublisher($pub_id,$pub_name)
	{
		$sql="UPDATE tbl_pub SET pub_name='$pub_name' WHERE pub_id=$pub_id";
		return $result = $this->conn->query($sql);
	}

	/* Students */
	function saveStudent($stud_name,$stud_father,$stud_dob,$stud_photo,$stud_lib_card_no,$class_id,$stud_sem,$stud_year,$stud_gender,$stud_mob,$stud_email,$stud_address)
	{
		 $sql="INSERT INTO tbl_student(stud_name,stud_father,stud_dob,stud_photo,stud_lib_card_no,class_id,stud_semester,stud_year,stud_gender,stud_mobile,stud_email,stud_address)VALUES('$stud_name','$stud_father','$stud_dob','$stud_photo','$stud_lib_card_no',$class_id,'$stud_sem','$stud_year','$stud_gender','$stud_mob','$stud_email','$stud_address')";
		//  echo $sql;
		 return $result = $this->conn->query($sql);
	}
	function searchClass($stud_class)
	{
		 $sql="SELECT * FROM tbl_class WHERE class_name LIKE '%$stud_class%'";
		 $result = $this->conn->query($sql);
		?>
		<table class="table table-bordered" >
		<?php
		while($row=$result->fetch_array())
		{ ?>
		<tr onclick="select_class('<?php echo $row['class_id']; ?>','<?php echo $row['class_name'];?>');" class="table-click">
		<td> <?php echo $row['class_name']; ?> </td>
		</tr>
		<?php } ?>
		</table>
		<?php
	}
	function showStudent1()
	{
		$sql="SELECT * FROM tbl_class";
		$result = $this->conn->query($sql);
		?>
		<table class="table table-bordered">
		<thead>
		<tr>
		<th>Sr.No</th>
		<th>Class Name</th>
		</tr>
		</thead>
		<tbody>
		<?php
			while($row=$result->fetch_assoc())
			{ ?>
				<tr class="table-click" onClick="showSem(<?php echo $row['class_id']; ?>);">
				<td><?php echo $this->count++; ?></td>
				<td> <?php echo $row['class_name']; ?></td>
				</tr>
				<!--</table> -->
			<?php } ?>
			</tbody>
			</table>
			<div id="add_stud" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add student</button></div>
	<?php
	}
	function showStudent2($class_id)
	{ 
		/* $sql="SELECT stud_semester,stud_year FROM tbl_student WHERE class_Id=$class_id";
		$result=$this->conn->query($sql); */
		?>
		<table class="table table-bordered">
			<thead>
				<th>Sr. No</th>
				<th>Semester</th>
				<th>Year</th>
			</thead>
			<tbody>
			<?php	// while($row=$result->fetch_assoc())
				{ ?>
				<!-- <tr onClick="showStudList('<?php echo $class_id; ?>','<?php echo $row['stud_semester']?>','<?php echo $row['stud_year'];?>')" class="table-click">
					<td><?php //echo $this->count++; ?></td>
					<td><?php //echo $row['stud_semester']; ?></td>
					<td><?php //echo $row['stud_year']; ?></td>
				</tr> -->
				<tr onClick="showStudList('<?php echo $class_id; ?>','Ist Semester','Ist Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>Ist Semester</td>
					<td>Ist Year</td>
				</tr>
				<tr onClick="showStudList('<?php echo $class_id; ?>','IInd Semester','Ist Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>IInd Semester</td>
					<td>Ist Year</td>
				</tr>
				<tr onClick="showStudList('<?php echo $class_id; ?>','IIIrd Semester','IInd Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>IIIrd Semester</td>
					<td>IInd Year</td>
				</tr>
				<tr onClick="showStudList('<?php echo $class_id; ?>','IVth Semester','IInd Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>IVth Semester</td>
					<td>IInd Year</td>
				</tr>
				<tr onClick="showStudList('<?php echo $class_id; ?>','Vth Semester','IIIrd Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>Vth Semester</td>
					<td>IIIrd Year</td>
				</tr>
				<tr onClick="showStudList('<?php echo $class_id; ?>','VIth Semester','IIIrd Year')" class="table-click">
					<td><?php echo $this->count++; ?></td>
					<td>VIth Semester</td>
					<td>IIIrd Year</td>
				</tr>
	<?php
		} ?>
		</tbody>
		</table>
		<div id="back_btn" style="float:left"><button type="button" class="btn btn-add" onClick="load_data();">Back</button></div>
		<div id="add_stud" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add student</button></div>
<?php	}
function showStudent3($class_id,$stud_sem,$stud_year)
{
	$sql="SELECT st.stud_id, st.stud_name,st.stud_father,st.stud_lib_card_no,cls.class_id FROM tbl_student st INNER JOIN tbl_class cls ON st.class_id = cls.class_id Where st.class_id =$class_id AND st.stud_semester='$stud_sem' AND st.stud_year='$stud_year'";
	$result=$this->conn->query($sql);
	?>
	<table class="table table-bordered">
	<thead>
		<tr>
		<th>Sr.No.</th>
		<th>Name</th>
		<th>Father's Name</th>
		<th>Library card Number</th>
	</tr>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc())
		{
			$class_id = $row['class_id'];
		?>
		<tr onclick="showStud(<?php echo $row['stud_id']; ?>)" class="table-click">
			<td><?php echo $this->count++; ?></td>
			<td><?php echo ucfirst($row['stud_name']); ?></td>
			<td><?php echo ucfirst($row['stud_father']); ?></td>
			<td><?php echo $row['stud_lib_card_no']; ?></td>
		</tr>
			<?php }	?>
		<tbody>
		</table>
			<div id="back_btn" style="float:left"><button type="button" class="btn btn-add" onClick="showSem(<?php echo $class_id; ?>);">Back</button></div>
			<div id="add_stud" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add student</button></div>

<?php
}
	function showStudent($stud_id)
	{
		// $sql="SELECT st.stud_id,st.stud_name, st.stud_father, st.stud_dob, st.stud_lib_card_no,cls.class_id,cls.class_name, st.stud_semester, st.stud_year, st.stud_gender, st.stud_mobile, st.stud_fine_amount, iss.issue_id, iss.issue_fine_amount FROM tbl_student st INNER JOIN tbl_class cls ON st.class_id=cls.class_id INNER JOIN tbl_issue iss ON st.issue_id=iss.issue_id  ";
	  	$sql="SELECT st.stud_id,st.stud_name, st.stud_father, st.stud_dob, st.stud_lib_card_no,st.stud_photo,st.class_id,cls.class_id,cls.class_name, st.stud_semester, st.stud_year, st.stud_gender, st.stud_mobile, st.stud_email, st.stud_address FROM tbl_student st INNER JOIN tbl_class cls ON st.class_id=cls.class_id Where st.stud_id =$stud_id";
		$result=$this->conn->query($sql);
		?>
		<!-- <table class="table table-bordered">
		<thead>
		<tr>
		<th>Sr.No.</th>
		<th>Name</th>
		<th>Library card Number</th>
		<th>Class</th>
		<th>Semester/Year</th>
		<th>Contact Number</th>
		<th>Fine Amount</th> 
		<th colspan="2">Operations</th>
		</tr>
		</thead>
		<tbody> -->

		<?php
		$row=$result->fetch_assoc();
			/* if($row['issue_id']==0)
			{
				$issue_fine="0";
			}
			else{
				$issue_fine=$row['issue_fine_amount'];
			} */
			$class_id = $row['class_id'];
			/*
			<tr>
			<td><?php echo $this->count++; ?></td>
			<td><?php echo ucfirst($row['stud_name']).' '.(($row['stud_gender']=='Male')?'S/O ':'D/O ').ucfirst($row['stud_father']); ?></td>
			<td><?php echo $row['stud_lib_card_no']; ?></td>
			<td><?php echo $row['class_name']; ?></td>
			<td><?php echo $row['stud_semester'].'/'.$row['stud_year']; ?></td>
			<td><?php echo $row['stud_mobile']; ?> </td>
			<!-- <td> <?php// echo '<i class="fa fa-inr"> </i>'.$issue_fine ;?> </td> -->
			<td><a href="#" onClick="edit_student('<?php echo $row['stud_id']; ?>');" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil" title="Edit"></a></td>
			<td><a href="#" onClick="delete_student('<?php echo $row['stud_id']; ?>');"><span class="fa fa-trash" title="Delete"></a></td>
			</tr> 
		<tbody>
		</table>*/
		$stud_dob = $row['stud_dob'];
		$stud_dob = strtotime($stud_dob);
		$stud_dob = date('d-M-Y',$stud_dob);
		?>
	  <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title"><?php echo ucfirst($row['stud_name']).' '.(($row['stud_gender']=='Male')?'S/O ':'D/O ').ucfirst($row['stud_father']); ?></h3>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-3 col-lg-3 "> <img alt="Student Picture" src="<?php echo $row['stud_photo']; ?>" class="img-circle img-responsive"> </div>
               <div class=" col-md-4 col-lg-9 ">
                  <table class="table table-user-information">
                     <tbody>
                        <tr>
                           <td>Library Card Number</td>
                           <td><?php echo $row['stud_lib_card_no']; ?></td>
                        </tr>
                        <tr>
                           <td>Date of Birth</td>
                           <td><?php echo $stud_dob; ?></td>
                        </tr>
                        <tr>
                           <td>Gender</td>
                           <td><?php echo $row['stud_gender']; ?></td>
                        </tr>
                        <tr>
                           <td>Class Name</td>
                           <td><?php echo $row['class_name']; ?></td>
                        </tr>
                        <tr>
                           <td>Semester / Year</td>
                           <td><?php echo $row['stud_semester'].' / '.$row['stud_year']; ?></td>
                           <!-- <td><a href="mailto:info@support.com">info@support.com</a></td> -->
                        </tr>
                        <tr>
                           <td>Phone Number</td>
                           <td><?php echo $row['stud_mobile'];?></td>
                        </tr>
                        <tr>
                           <td>E-Mail</td>
                           <td>
                              <a href="mailto:<?php echo $row['stud_email'];?>">
                                 <?php echo $row['stud_email'];?>
                           </td>
                        </tr>
                        <tr>
                        <td>Address</td>
                        <td><?php echo $row['stud_address'];?></td> 
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <span class="pull-right">
            <a href="#" title="Edit this Record" class="btn btn-sm btn-warning"  onClick="edit_student('<?php echo $row['stud_id']; ?>');" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>
            <a href="#" title="Remove this Record" class="btn btn-sm btn-danger" onClick="delete_student('<?php echo $row['stud_id']; ?>');"><i class="fa fa-trash"></i></a>
            </span>
         	</div>
      </div>
      <div id="back_btn" style="float:left"><button type="button" class="btn btn-add" onClick="showStudList('<?php echo $class_id; ?>','<?php echo $row['stud_semester']?>','<?php echo $row['stud_year'];?>');">Back</button></div>
      <div id="add_stud" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add student</button></div>
		<?php
	}
	function editStudent($stud_id)
	{
		 $sql="SELECT st.stud_id,st.stud_name, st.stud_father, st.stud_dob, st.stud_lib_card_no,cls.class_id,cls.class_name, st.stud_semester, st.stud_year, st.stud_gender, st.stud_mobile, st.stud_email, st.stud_address FROM tbl_student st INNER JOIN tbl_class cls ON st.class_id=cls.class_id  WHERE stud_id=$stud_id";
		 $result = $this->conn->query($sql);
		while($row=$result->fetch_assoc())
		{
			$stud_dob=$row['stud_dob'];
			$stud_dob=strtotime($stud_dob);
			$stud_dob=date('d/m/Y',$stud_dob);
	?>
		<form method="POST" id="update_stud_frm" onsubmit="return false;" autocomplete='on'>
			<table class="table table-bordered table-striped">
			<!--<td><input type="hidden" name="stud_id" id="stud_id" value="<?php// echo $row['stud_id']; ?>" required /> </td>-->
			<tr>
				<td>Student Name</td>
				<td><input type="text" name="stud_name" id="stud_name" placeholder="Enter The Student Name" value="<?php echo $row['stud_name']; ?>"  class="form-control" required /> </td>
			</tr>
			<tr>
				<td>Student Father's Name</td>
				<td><input type="text" id="stud_father" name="stud_father" placeholder="Enter the Father name" value="<?php echo $row['stud_father']; ?>" class="form-control"  required /> </td>
			</tr>
			<tr>
				<td>Date Of Birth</td>
				<td><input type="text" id="stud_dob" name="stud_dob" placeholder="Enter Date of Birth" class="form-control"  value="<?php echo $stud_dob; ?>" required /></td>
			</tr>
			<tr>
				<td>Upload Photo</td>
				<td><input type="file" name="stud_photo" id="stud_photo"  /></td>
			</tr>
			<tr>
				<td>Library Card Number</td>
				<td><input type="text" name="stud_lib_card_no" id="stud_lib_card_no" Placeholder="Enter Library Card Number" value="<?php echo $row['stud_lib_card_no']; ?>" class="form-control" required /></td>
			</tr>
			<tr>
				<td>Class Name</td>
				<td><input type="hidden" id="stud_class_id" name="stud_class_id" value="<?php echo $row['class_id']; ?>"  />
				<input type="text" name="stud_class" id="stud_class" placeholder="Search Class Name" value=" <?php echo $row['class_name']; ?>" onKeyUp="search_class();" autocomplete='off' class="form-control" required />
				<div id="search_result">
				</div>
				</td>
			</tr>
			<tr>
				<td>Semester</td>
				<td><select id="stud_sem" name="stud_sem" class="form-control" >
				<option value="<?php echo $row['stud_semester'];?>"><?php echo $row['stud_semester']; ?></option>
				<option value="Ist Semester" <?php echo (($row['stud_semester']=='Ist Semester')?'hidden':''); ?> >Ist Semester</option>
				<option value="IInd Semester" <?php echo (($row['stud_semester']=='IInd Semester')?'hidden':''); ?>>IInd Semester</option>
				<option value="IIIrd Semester" <?php echo (($row['stud_semester']=='IIIrd Semester')?'hidden':''); ?> >IIIrd Semester</option>
				<option value="IVth Semester" <?php echo (($row['stud_semester']=='IVth Semester')?'hidden':''); ?>>IVth Semester</option>
				<option value="Vth Semester" <?php echo (($row['stud_semester']=='Vth Semester')?'hidden':''); ?> >Vth Semester</option>
				<option value="VIth Semester" <?php echo (($row['stud_semester']=='VIth Semester')?'hidden':''); ?> >VIth Semester</option></td>
			</tr>
			<tr>
				<td>Year</td>
				<td><select id="stud_year" name="stud_year" class="form-control" >
				<option value="<?php echo $row['stud_year'];?>"><?php echo $row['stud_year']; ?></option>
				<option value="Ist Year" <?php echo (($row['stud_year']=='Ist Year')?'hidden':''); ?> >Ist Year</option>
				<option value="IInd Year" <?php echo (($row['stud_year']=='IInd Year')?'hidden':''); ?> >IInd Year</option>
				<option value="IIIrd Year"  <?php echo (($row['stud_year']=='IIIrd Year')?'hidden':''); ?> >IIIrd Year</option></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><Select id="stud_gender" name="stud_gender" class="form-control" >
				<option value="<?php echo $row['stud_gender'];?>"><?php echo $row['stud_gender']; ?></option>
				<option value="Male" <?php echo (($row['stud_gender']=='Male')?'hidden':''); ?> >Male</option>
				<option value="Female"  <?php echo (($row['stud_gender']=='Female')?'hidden':''); ?> >Female</option></td>
			</tr>
			<tr>
			<td>Mobile</td>
				<td><input type="text" name="stud_mob" id="stud_mob" placeholder="Enter the Mobile Number" value="<?php echo $row['stud_mobile'];?>" pattern="[0-9]{10}" maxlength="10" class="form-control"  /></td>
			</tr>
			<tr>
			<td>E-mail</td>
				<td><input type="e-mail" name="stud_email" id="stud_email" placeholder="Enter the E-Mail" tooltip="Enter Valid E-Mail" value="<?php echo $row['stud_email'];?>" class="form-control"  /></td>
			</tr>
			<tr>
			<td>Address</td>
				<td>
					<textarea class="form-control" name="stud_address" id="stud_address" rows="3" placeholder="Enter Address"><?php echo $row['stud_address']; ?> </textarea>
				</div></td>
			</tr>
			<!-- <tr>
				<td>Fine Amount</td>
				<td><input type="number" name="stud_fine_amount" id="stud_fine_amount" placeholder="Enter Fine Amount" value="<?php echo $row['stud_fine_amount'];?>" class="form-control" required /></td>
			</tr> -->
			<tr>
				<td></td>
				<td><button  value="update" name="submit" id="submit" class="btn btn-primary" onClick="update_student('<?php echo $row['stud_id']; ?>');" type="submit" >Update</button>
				<button type="button" value="cancel" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Cancel</button></td>

	<?php
		}
		echo "</table></form>";
	}
	function updatestudent($stud_id,$stud_name,$stud_father,$stud_dob,$stud_photo,$stud_lib_card_no,$class_id,$stud_sem,$stud_year,$stud_gender,$stud_mob,$stud_email,$stud_address)
	{
		$sql="UPDATE tbl_student SET stud_name='$stud_name',stud_father='$stud_father',stud_dob='$stud_dob',stud_photo='$stud_photo',stud_lib_card_no='$stud_lib_card_no',class_id=$class_id,stud_semester='$stud_sem',stud_year='$stud_year',stud_gender='$stud_gender',stud_mobile='$stud_mob',stud_email='$stud_email',stud_address='$stud_address' WHERE stud_id=$stud_id";

		return $result = $this->conn->query($sql);
	}
	function deleteStudent($stud_id)
	{
	  $sql="DELETE FROM tbl_student WHERE stud_id=$stud_id";
		return $result = $this->conn->query($sql);/*data cannot be delete because of foreign key constraint*/ /*how to print database error*/
	}

	/*Books*/
	function saveBook($book_name,$auth_id,$pub_id,$book_price,$book_pages,$book_code,$book_language,$no_of_books)
	{
		$sql="INSERT INTO tbl_books(book_name,auth_id,pub_id,book_price,book_pages,book_code,book_language,no_of_books) VALUES ('$book_name',$auth_id,$pub_id,'$book_price','$book_pages','$book_code','$book_language','$no_of_books')";
		return $result = $this->conn->query($sql);
	}
	function searchAuthor($auth_name)
	{
		$sql="SELECT * FROM tbl_authors WHERE auth_name LIKE '%$auth_name%'";
		$result = $this->conn->query($sql);
		echo "<table class='table table-bordered'>";
		while($row=$result->fetch_assoc())
		{ ?>
			<tr onClick="select_author('<?php echo $row['auth_id']; ?>','<?php echo $row['auth_name']; ?>');" class="table-click" class="table-click">
			<td><?php echo $row['auth_name']; ?></td>
			</tr>
	<?php }
				echo "</table>";
	}
	function searchPublisher($pub_name)
	{
		$sql="SELECT * FROM tbl_pub WHERE pub_name LIKE '%$pub_name%'";
		$result = $this->conn->query($sql);
		echo "<table class='table table-bordered'>";
		while($row=$result->fetch_assoc())
		{ ?>
			<tr onClick="select_publisher('<?php echo $row['pub_id']; ?>','<?php echo $row['pub_name']; ?>');" class="table-click">
			<td><?php echo $row['pub_name']; ?></td>
			</tr>
	<?php }
				echo "</table>";
	}
	function showBook()
	{
		$sql="SELECT bks.book_id,bks.book_name,au.auth_name,pu.pub_name,bks.book_price,bks.book_pages,bks.book_code,bks.book_language,bks.no_of_books FROM tbl_books bks INNER JOIN tbl_authors au ON bks.auth_id=au.auth_id INNER JOIN tbl_pub pu ON bks.pub_id=pu.pub_id";
		$result=$this->conn->query($sql);
		?>
		<table class="table table-bordered table-striped table-hover table-responsive">
		<thead>
		<tr>
		<th>Sr.No</th>
		<th>Book Name</th>
		<th>Author / Publisher</th>
		<th>Book Price</th>
		<th>Book Code</th>
		<th>Book Language</th>
		<th>Books Available</th>
		<th colspan="2">Operations</th>
		</tr>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc())
		{ ?>
			<tr>
			<td><?php echo $this->count++; ?></td>
			<td><?php echo $row['book_name']; ?></td>
			<td><?php echo ucwords($row['auth_name']); ?> / <?php echo $row['pub_name']; ?></td>
			<td><?php echo '₹'.$row['book_price']; ?></td>
			<td><?php echo $row['book_code']; ?></td>
			<td><?php echo $row['book_language']; ?></td>
			<td><?php echo $row['no_of_books']; ?></td>
			<td><a href="#" onClick="edit_book('<?php echo $row['book_id']; ?>');" data-toggle='modal' data-target='#myModal'><span class="fa fa-pencil" title="Edit"></span> </a></td>
			<td><a href="#" onClick="delete_book('<?php echo $row['book_id']; ?>');"><span class="fa fa-trash" title="Delete"></span></a></td>
			</tr>
		<?php }	?>
			</tbody>
		</table>
		<div id="add_book" class="addbtn"><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();"><span class="fa fa-plus"></span> Add Book</button></div>

<?php	}
	function editBook($book_id)
	{
		$sql="SELECT bks.book_id,bks.book_name,au.auth_id,au.auth_name,pu.pub_id,pu.pub_name,bks.book_price,bks.book_pages,bks.book_code,bks.book_language,bks.no_of_books FROM tbl_books bks INNER JOIN tbl_authors au ON bks.auth_id=au.auth_id INNER JOIN tbl_pub pu ON bks.pub_id=pu.pub_id WHERE bks.book_id=$book_id";
		$result = $this->conn->query($sql);
		$row=$result->fetch_assoc();
		?>
		<form id="update_book_frm" onsubmit="return false;" enctype="formdata/multipart">
			<table class="table table-bordered table-striped">
			<tr>
				<td>Book Name</td>
				<td><input type="text" name="book_name" id="book_name" placeholder="Enter The Book Name" class="form-control" value="<?php echo $row['book_name']; ?>" required /> </td>
			</tr>
			<tr>
				<td>Author Name</td>
				<td><input type="hidden" id="auth_id" name="auth_id" value="<?php echo $row['auth_id']; ?>" />
				<input type="text" id="auth_name" name="auth_name" placeholder="Search Author" class="form-control"  onKeyUp="search_author();" value="<?php echo $row['auth_name']; ?>" required />
				<div id="author_result">
				</div></td>
			</tr>
			<tr>
				<td>Publisher Name</td>
				<td><input type="hidden" id="pub_id" name="pub_id" value="<?php echo $row['pub_id']; ?>" />
				<input type="text" id="pub_name" name="pub_name" placeholder="Search Publisher" class="form-control"  onKeyUp="search_publisher();"  value="<?php echo $row['pub_name']; ?>" required />
				<div id="publisher_result">
				</div></td>
			</tr>
			<tr>
				<td>Book Price</td>
				<td><input type="text" name="book_price" id="book_price" class="form-control"  Placeholder="Enter the Book price" value="<?php echo $row['book_price']; ?>" required /></td>
			</tr>
			<tr>
				<td>Book Pages</td>
				<td><input type="number" name="book_pages" id="book_pages" placeholder="Enter the Number Of Pages" class="form-control"  value="<?php echo $row['book_pages']; ?>"  required /></td>
			</tr>
			<tr>
				<td>Book Code</td>
				<td><input type="text" name="book_code" id="book_code" placeholder="Enter Book Code" class="form-control" value="<?php echo $row['book_code']; ?>" required /></td>
			</tr>
			<tr>
				<td>Book Language</td>
				<td><select id="book_language" name="book_language" class="form-control" required>
				<option  value="<?php echo $row['book_language']; ?>"><?php echo $row['book_language']; ?></option>
				<option value="English">English</option>
				<option value="Hindi">Hindi</option></td>
				</select>
			</tr>
			<tr>
				<td>Books Available</td>
				<td><input type="number" id="no_of_books" name="no_of_books" class="form-control" placeholder="Enter Number Of Books" value="<?php echo $row['no_of_books']; ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td><button value="Update" name="submit" id="submit" class="btn btn-primary" onClick="update_book('<?php echo $row['book_id']; ?>');" type="button" data-dismiss="modal">Update</button>
				<button type="button" value="cancel" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Cancel</button></td>
				 </table>
		 </form>
				<?php
	}
	function updateBook($book_id,$book_name,$auth_id,$pub_id,$book_price,$book_pages,$book_code,$book_language,$no_of_books)
	{
		$sql="UPDATE tbl_books SET book_name='$book_name',auth_id=$auth_id,pub_id=$pub_id,book_price='$book_price',book_pages='$book_pages',book_code='$book_code',book_language='$book_language',no_of_books='$no_of_books' WHERE book_id=$book_id";
		return $result = $this->conn->query($sql);
	}
	function deleteBook($book_id)
	{
		 $sql="DELETE FROM tbl_books WHERE book_id=$book_id";
		 return $result = $this->conn->query($sql);
	}


	/* Issue */
	function saveIssue($stud_id,$book_id,$issue_date,$issue_return_date,$issue_returned_or_not,$issue_fine_or_not,$issue_fine)
	{
		$sql="INSERT INTO tbl_issue (stud_id,book_id,issue_date,issue_return_date,issue_returned_or_not,issue_fine_or_not,issue_fine_amount)VALUES($stud_id,$book_id,'$issue_date','$issue_return_date',$issue_returned_or_not,$issue_fine_or_not,'$issue_fine')";
		return $result = $this->conn->query($sql);
	}
	function searchStudent($stud_detail)
	{
		$sql="SELECT * FROM tbl_student WHERE stud_name LIKE '%$stud_detail%' OR stud_lib_card_no LIKE '%$stud_detail%' OR stud_mobile LIKE '%$stud_detail%'";
		$result = $this->conn->query($sql);
		echo "<table class='table table-bordered '>
		<th>Sr.No</th>
		<th>Student Details</th>
		<th>Contact Number</th>";
		while($row=$result->fetch_assoc())
		{?>
			<tr onClick="select_student('<?php echo $row['stud_id']; ?>','<?php echo $row['stud_name']; ?>');" class="table-click">
			<td><?php echo $this->count++; ?></td>
			<td><?php echo '<b>'.$row['stud_lib_card_no']."</b><br/>".$row['stud_name'].(($row['stud_gender']=='Male')?' S/O ':' D/O ').$row['stud_father']; ?></td>
			<td><?php echo $row['stud_mobile']; ?></td>
			</tr>
		<?php }
		echo "</table>";
	}
	function searchBook($book_name)
	{
		$sql="SELECT * FROM tbl_books WHERE book_name LIKE '%$book_name%'";
		$result=$this->conn->query($sql);
		echo "<table class='table table-bordered'>
		<th>Sr.No</th>
		<th>Book Details</th>
		<th>Book Quantity</th>";
		$cnt=0;
		while($row=$result->fetch_array())
		{ ?>
			<tr onClick="select_book('<?php echo $row['book_id']; ?>','<?php echo $row['book_name']; ?>');" class="table-click">
			<td><?php echo $this->count++; ?></td>
			<td> <?php echo "<b>".$row['book_code']."</b><br/>".$row['book_name']; ?> </td>
			<td><?php echo $row['no_of_books']; ?></td>
			</tr>
		<?php }
		echo "</table>";
	}
	function showIssuedBook1()
	{ ?>
		<br/>	<br/>
		<div class="input-group issue-search-group">
			<input type='text' id='lib_search' autocomplete="off" name='lib_search' class='issue-search' placeholder='Enter Library Card Number to Search' onKeyUp='lib_search();' autofocus />
			<div class="input-group-btn">
				<button class='btn btn-search' style="height:50px; width:50px; border-radius:10px;border-top-left-radius: 0px; border-bottom-left-radius: 0px;" onClick="lib_search();"><i class='fa fa-search'></i></button>
			</div>
		</div>
		<div id="lib_search_result"></div>
		<br/>
		<div id="add_issue" class="addbtn" ><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();" ><span class="fa fa-plus"></span> Issue Book</button></div>	
	<?php
	}
	function libSearch($data)
	{
		$sql="SELECT st.stud_id,st.stud_name, st.stud_father, st.stud_lib_card_no,cls.class_id,cls.class_name, st.stud_semester, st.stud_year, st.stud_gender, st.stud_mobile FROM tbl_student st INNER JOIN tbl_class cls ON st.class_id=cls.class_id WHERE st.stud_lib_card_no LIKE '%$data%' OR st.stud_name LIKE '%$data%'";
		$result = $this->conn->query($sql); ?>
		<table class='table table-bordered'>
		<thead>
		<tr>
		<th>Student Name</th>
		<th>Library Card Number</th>
		<th>Class</th>
		<th>Semester / Year</th>
		</tr>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc())
		{ ?>
		<tr onClick="select_student_result('<?php echo $row['stud_id']; ?>');" class="table-click">
		<td><?php echo ucfirst($row['stud_name']).' '.(($row['stud_gender']=='Male')?'S/O':'D/O').' '.ucfirst($row['stud_father']); ?></td>
		<td><?php echo $row['stud_lib_card_no']; ?></td>
		<td><?php echo $row['class_name']; ?></td>
		<td><?php echo $row['stud_semester'].' / '.$row['stud_year'] ; ?></td>
		<?php
		}
	}
	function showIssuedBook($stud_id)
	{
		// $conn = $this->ConnectionFun();
	  $sql="SELECT iss.issue_id,st.stud_id,st.stud_name,bks.book_id,bks.book_name,bks.book_code,iss.issue_date,iss.issue_return_date,iss.issue_returned_or_not,iss.issue_fine_amount FROM tbl_issue iss INNER JOIN tbl_student st ON iss.stud_id=st.stud_id INNER JOIN tbl_books bks ON iss.book_id=bks.book_id WHERE iss.stud_id = $stud_id";
		$result = $this->conn->query($sql);
	/* 	echo " <table class='table table-bordered table-striped table-hover'>
		<thead>
		<tr>
		<th>Sr.No</th>
		<th>Student Name</th>
		<th>Book Name</th>
		<th>Book Code</th>
		<th>Issue date/Return Date</th>
		<th>Returned Status</th>
		<th>Fine Amount</th>
		<th colspan='2'>Operations</th>
		</tr>
		</thead>
		<tbody>"; */
		// $row=$result->fetch_assoc();
		// echo "<h3>".ucfirst($row['stud_name'])."</h3>";
		while($row=$result->fetch_assoc()){
			//formating time to 01-Jan-2018
			$issue_date=$row['issue_date'];
			$issue_return_date=$row['issue_return_date'];
			$issue_date=strtotime($issue_date);
			$issue_return_date=strtotime($issue_return_date);
			$issue_date=date('d-M-Y',$issue_date);
			$issue_return_date=date('d-M-Y',$issue_return_date);
	?> 
	<?php /*
			<tr>
			<td><?php echo $this->count++; ?> </td>
			<td><?php echo ucfirst($row['stud_name']); ?> </td>
			<td><?php echo $row['book_name']; ?> </td>
			<td><?php echo $row['book_code']; ?> </td>
			<td><?php echo $issue_date.'<br/>'.$issue_return_date; ?></td>
			<td><?php echo (($row['issue_returned_or_not']==1)?'Yes':'No'); ?></td>
			<td><?php echo "₹ ".$row['issue_fine_amount']; ?></td>
			<td><a href="#" onClick="edit_issue('<?php echo $row['issue_id']; ?>');"data-toggle="modal" data-target="#myModal"><span class='fa fa-pencil' title='Edit'></span></a></td>
			<td><a href="#" onClick="delete_issue('<?php echo $row['issue_id']; ?>');"><span class='fa fa-trash' title='Delete'></span></a></td>
			</tr>
		<?php }*/
		// $conn->close();
		?>
		<!-- </tbody>
		</table> -->
		<div class="panel panel-default">
		 <div class="panel-heading">
			 <h3 class="panel-title"><?php echo ucfirst($row['stud_name']); ?></h3>
		 </div>
		 <div class="panel-body">
			 <div class="row">
				 <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Book Name</td>
                        <td><?php echo $row['book_name']; ?></td>
                      </tr>
                      <tr>
                        <td>Book Code</td>
                        <td><?php echo $row['book_code']; ?></td>
                      </tr>
                      <tr>
                        <td>Issue Date</td>
                        <td><?php echo $issue_date; ?></td>
                      </tr>
                        <tr>
                        <td>Issue Return Date</td>
                        <td><?php echo $issue_return_date; ?></td>
                      </tr>
                      <tr>
												<td>Returned Or Not</td>
												<td><?php echo (($row['issue_returned_or_not']==1)?'Yes':'No'); ?></td>
                        <!-- <td><a href="mailto:info@support.com">info@support.com</a></td> -->
                      </tr>
                        <td>Fine Amount</td>
                        <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $row['issue_fine_amount'];?></td> 
                      </tr>
                    </tbody>
									</table>
									</div>
									</div>
									<span class="pull-right">
                            <a href="#" title="Edit this Record" class="btn btn-sm btn-warning"  onClick="edit_issue('<?php echo $row['issue_id']; ?>');" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>
                            <a href="#" title="Remove this Record" class="btn btn-sm btn-danger" onClick="delete_issue('<?php echo $row['issue_id']; ?>');"><i class="fa fa-trash"></i></a>
                        </span>
            </div>
                 <div class="panel-footer">
                        
                    </div>
        </div>
		<?php } ?>
		<div id="add_issue" class="addbtn" ><button type='button' id="toggle-button" class="btn btn-add" data-toggle="modal" data-target="#myModal" onClick="load_input_table();" ><span class="fa fa-plus"></span> Issue Book</button></div>
<?php
}
	function editIssue($issue_id)
	{
		$sql="SELECT iss.issue_id,st.stud_id,st.stud_name,bk.book_id,bk.book_name,iss.issue_date,iss.issue_return_date,iss.issue_returned_or_not,issue_fine_or_not,iss.issue_fine_amount FROM tbl_issue iss INNER JOIN tbl_student st ON iss.stud_id=st.stud_id INNER JOIN tbl_books bk ON iss.book_id = bk.book_id WHERE iss.issue_id=$issue_id";
		$result = $this->conn->query($sql);
		$row=$result->fetch_assoc();
			//formating time to 01-Jan-2018
			$issue_date=$row['issue_date'];
			$issue_return_date=$row['issue_return_date'];
			$issue_date=strtotime($issue_date);
			$issue_return_date=strtotime($issue_return_date);
			$issue_date=date('d-m-Y',$issue_date);
			$issue_return_date=date('d-m-Y',$issue_return_date);
			//assigning values to variable for if else.....
			$issue_returned_or_not=$row['issue_returned_or_not'];
			$issue_fine_or_not=$row['issue_fine_or_not'];
			?>
			<form id='update_issue_frm' onsubmit="return false" enctype='formdata/multipart'>
			<table class='table table-bordered table-striped'>
			<tr>
				<td>Student Card No</td>
				<td><input type="hidden" id="stud_id" name="stud_id" value="<?php echo $row['stud_id']; ?>" />
				<input type="text" id="stud_detail" name="stud_detail" placeholder="Search Student" class="form-control" onKeyUp="search_student();" value="<?php echo $row['stud_name']; ?>" required />
				<div id="student_result">
				</div></td>
			</tr>
			<tr>
				<td>Book Name</td>
				<td><input type="hidden" id="book_id" name="book_id" value="<?php echo $row['book_id']; ?>" />
				<input type="text" id="book_detail" name="book_detail" placeholder="Search Book" class="form-control" value="<?php echo $row['book_name']; ?>" onKeyUp="search_book();" required />
				<div id="book_result">
				</div></td>
			</tr>
			<tr>
				<td>Issue Date</td>
				<td><input type="text" id="issue_date" name="issue_date" class="form-control" value="<?php echo $issue_date; ?>" disabled />
				<a href="#" id="edit_attr" onClick="change();" >Edit</a>
				<a href="#" id="ok_btn" onClick="add_time();" hidden>Ok</a></td>
			</tr>
			<tr>
				<td>Return Date</td>
				<td><input type="text" id="issue_return_date" name="issue_return_date" class="form-control" value="<?php echo $issue_return_date; ?>" disabled />
				<a href="#" id="edit_date" href="#" onClick="change_return();" >Edit</a></td>
			</tr>
			<tr>
				<td>Returned Or Not</td>
				<td><select id="issue_returned_or_not" name="issue_returned_or_not" class="form-control" required>
				<option value="<?php echo $issue_returned_or_not; ?>"><?php echo (($issue_returned_or_not==1)?'Yes':'No'); ?></option>
				<option value="1" <?php echo (($issue_returned_or_not==1)?'hidden':''); ?> >Yes</option>
				<option value="0" <?php echo (($issue_returned_or_not==0)?'hidden':''); ?> >No</option>
				</select> </td>
			</tr>
			<tr>
				<td>Fine Or Not</td>
				<td><select id="issue_fine_or_not" name="issue_fine_or_not" class="form-control" onChange="fine_amount_const();" required>
				<option value="<?php echo $issue_fine_or_not; ?>"> <?php echo(($issue_fine_or_not==1)?'Yes':'No'); ?> </option>
				<option value="1" <?php echo (($issue_fine_or_not==1)?'hidden':''); ?> >Yes</option>
				<option value="0" <?php echo (($issue_fine_or_not==0)?'hidden':''); ?> >No</option>
				</select> </td>
			</tr>
			<tr>
				<td>Fine Amount</td>
				<td><input type="number" id="issue_fine" name="issue_fine" placeholder="Enter Fine Amount" class="form-control" value="<?php echo $row['issue_fine_amount']; ?>" <?php echo (($row['issue_fine_amount']==0)?"disabled":""); ?> /></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="submit" id="submit" class="btn btn-primary" onClick="update_issue(<?php echo $issue_id; ?>);"  data-dismiss='modal'>Update</button>
				<button type="button" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
			</tr>
			</table>
			</form>
	<?php 
	}

	function updateIssue($issue_id,$stud_id,$book_id,$issue_date,$issue_return_date,$issue_returned_or_not,$issue_fine_or_not,$issue_fine)
	{
		//formating the dates....
		$issue_date=strtotime($issue_date);
		$issue_date=date('Ymdhms',$issue_date);
		$issue_return_date=strtotime($issue_return_date);
		$issue_return_date=date('Ymdhms',$issue_return_date);

		$sql="UPDATE tbl_issue SET stud_id=$stud_id,book_id=$book_id,issue_date='$issue_date',issue_return_date='$issue_return_date',issue_returned_or_not=$issue_returned_or_not,issue_fine_or_not=$issue_fine_or_not,issue_fine_amount='$issue_fine' WHERE issue_id=$issue_id ";
		return $result = $this->conn->query($sql);;
	}
	function deleteIssue($issue_id)
	{
		$sql="DELETE FROM tbl_issue WHERE issue_id=$issue_id";
		return $result = $this->conn->query($sql);;
	}

/* Transactions functions */
	function saveTransact($tr_date,$tr_particular,$tr_amount,$tr_type)
	{
		$sql="INSERT INTO tbl_transaction(tr_date,tr_particular,tr_amount,tr_type)VALUES('$tr_date','$tr_particular','$tr_amount',$tr_type)";
		return $result = $this->conn->query($sql);
	}
	function showTransact()
	{
		$sql="SELECT * FROM tbl_transaction";
		$result=$this->conn->query($sql);
		echo "<table class='table table-bordered table-striped table-hover'>
		<thead>
		<tr>
		<th> Sr.No </th>
		<th>Transaction Date</th>
		<th>Particular</th>
		<th>Amount</th>
		<th>Transaction Type</th>
		<th colspan='2'>Operations</th>
		</tr>
		</thead>
		<tbody>";
		while($row=$result->fetch_assoc())
		{
			$tr_date=$row['tr_date'];
			$tr_date=strtotime($tr_date);
			$tr_date=date('d-M-Y',$tr_date);
	?>
			<tr>
			<td><?php echo $this->count++; ?></td>
			<td><?php echo $tr_date; ?></td>
			<td><?php echo $row['tr_particular']; ?></td>
			<td><?php echo "₹ ".$row['tr_amount']; ?></td>
			<td><?php echo (($row['tr_type']==1)?"Dr.":"Cr."); ?></td>
			<td><a href="#" data-toggle="modal" data-target="#myModal" onClick="edit_transact('<?php echo $row['tr_id']; ?>');"><span class="fa fa-pencil" title="Edit" ></span></a></td>
			<td><a href="#" onClick="delete_transact('<?php echo $row['tr_id']; ?>');"><span class="fa fa-trash" title="Delete"></span></a></td>
			</tr>
		<?php }	?>
		</tbody>
		</table>
			<div id="add_transact" class="addbtn"><button type="button" class="btn btn-add" data-toggle="modal" data-target="#myModal"  onClick="load_input_table();" ><span class="fa fa-plus"></span> Add Entry</button></div>


		<?php }
	function editTransact($tr_id)
	{
		$sql="SELECT * FROM tbl_transaction WHERE tr_id=$tr_id";
		$result = $this->conn->query($sql);
		$row=$result->fetch_assoc();
			$tr_date=$row['tr_date'];
			$tr_date=strtotime($tr_date);
			$tr_date=date('d-m-Y',$tr_date);
			/*Getting tr_type value into variable for dropdown value*/
			$tr_type=$row['tr_type'];
	?>
			<form method="POST" onsubmit="return false;">
			<table class="table table-bordered table-striped">
			<tr>
				<td>Transaction date</td>
				<td>
				<input type="text"  id="tr_date" name="tr_date" value="<?php echo $tr_date; ?>" class="form-control" required disabled />
				<a href="#" id="edit_attr" href="#" onClick="change();" ><i class="fa fa-pencil"></i>Edit</a></td>
			</tr>
			<tr>
				<td>Particular</td>
				<td><textarea name="tr_particular" id="tr_particular" placeholder="Enter The Transaction Particular" class="form-control" required ><?php echo $row['tr_particular']; ?></textarea> </td>
			</tr>

			<tr>
				<td>Amount</td>
				<td><input type="text" id="tr_amount" name="tr_amount" placeholder="Enter Amount" class="form-control" value="<?php echo $row['tr_amount']; ?>" />
			</tr>
			<tr>
				<td>Type</td>
				<td><select id="tr_type" name="tr_type" class="form-control" required>
				<option value="<?php echo $tr_type; ?>"><?php echo (($tr_type==1)?"Dr.":"Cr."); ?></option>
				<option value="1" <?php echo (($tr_type==1)?"hidden":""); ?> >Dr.</option>
				<option value="0" <?php echo (($tr_type==1)?"":"hidden"); ?> >Cr.</option>
				</select> </td>
			</tr>
			<tr>
				<td></td>
				<td><button  value="Save" name="submit" id="submit" class="btn btn-primary" onClick="update_transact('<?php echo $tr_id; ?>');"  data-dismiss="modal">Update</button>
				<button type="button" name="reset" id="reset" class="btn btn-danger" onClick="load_input_table();">Clear</button></td>
	<?php
	echo '</table>.</form>';
	}
	function updateTransact($tr_id,$tr_date,$tr_particular,$tr_amount,$tr_type)
	{
		$sql="UPDATE tbl_transaction SET tr_date='$tr_date',tr_particular='$tr_particular',tr_amount='$tr_amount',tr_type=$tr_type WHERE tr_id=$tr_id";
		return $result = $this->conn->query($sql);
	}
	function deleteTransact($tr_id)
	{
		$sql="DELETE FROM tbl_transaction WHERE tr_id=$tr_id";
		return $result = $this->conn->query($sql);
	}
	/*Users Operations*/
	function addUser($user_name, $user_fname, $user_pswd,$user_type)
	{
		$sql="INSERT INTO tbl_user(user_name,user_password,user_full_name,user_type)VALUES('$user_name','$user_pswd','$user_fname','$user_type')";
		return $result = $this->conn->query($sql);

	}
	function showUsers()
	{
		$sql="SELECT * FROM tbl_user";
		$result=$this->conn->query($sql);
		?>
		<table class="table table-bordered table-hover table-striped">
		<thead>
		<tr>
			<th>Sr.No</th>
			<th>Full Name</th>
			<th>User Type</th>
			<th>User Name</th>
			<th colspan="2">Operations</th>
		</tr>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc())
		{ ?>
			<tr>
			<td><?php echo $this->count++; ?></td>
			<td><?php echo ucwords(strtolower($row['user_full_name'])); ?></td>
			<td><?php echo ucwords(strtolower($row['user_type'])); ?></td>
			<td><?php echo ucwords(strtolower($row['user_name'])); ?></td>
			<td><a href="#" onclick="edit_data('<?php echo $row['user_id']; ?>');" data-toggle='modal' data-target='#myModal'><span class="fa fa-pencil" title="Edit"></span></a></td>
			<td><a href="#" onclick="delete_data('<?php echo $row['user_id']; ?>');"><span class="fa fa-trash" title="Delete"></span></a></td>
			</tr>
	<?php } ?>
	</tbody>
		</table>
		<div id="add_user" class="addbtn">
		<button type="button" id="add_user" name="add_user" class="btn btn-add" onClick="load_input_table();" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add User </button>
		</div>
<?php	}
	function editUser($user_id)
	{
		$sql="SELECT * FROM tbl_user WHERE user_id=$user_id";
		$result = $this->conn->query($sql);
		$row=$result->fetch_assoc();
		?>
		<form type="POST" name="edit_user" id="edit_user" onsubmit="return false">
		<table class="table table-bordered table-striped">
			<tr>
				<td>User Name <span style="color:red"> *</span> </td>
				<td><input type="text" id="user_name" name="user_name" placeholder="User Name" class="form-control" value="<?php echo $row['user_name']; ?>" title="This Is Required field" required /></td>
			</tr>
			<tr>
				<td>User Password <span style="color:red"> *</span> </td>
				<td><input type="text" id="user_pswd" name="user_pswd" placeholder="User Password" value="<?php echo $row['user_password']; ?>" class="form-control" title="This Is Required field"  required /></td>
			</tr>
			<tr>
				<td>User Full Name <span style="color:red"> *</span> </td>
				<td><input type="text" id="user_fname" name="user_fname" placeholder="User Full Name" value="<?php echo $row['user_full_name']; ?>" class="form-control" title="This Is Required field"  required /></td>
			</tr>
			<tr>
				<td> User Type </td>
				<td><select id="user_type" name="user_type" class="form-control" required>
				<option value="<?php echo $row['user_type']; ?>"><?php echo $row['user_type']; ?></option>
				<option value="<?php echo (($row['user_type']=='Administrator')?'hidden':''); ?>">Administrator</option>
				<option value="<?php echo (($row['user_type']=='User')?'hidden':''); ?>">User</option></td>
				</select>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="update_data('<?php echo $row['user_id'];?>');" data-dismiss="modal">Update</button>
					<button type="reset" id="reset" name="reset" class="btn btn-danger" >Reset</button>
				</td>
			</tr>
		</table>
		</form>
<?php	}
	function updateUser($user_id, $user_name, $user_fname, $user_pswd, $user_type)
	{
		$sql="UPDATE tbl_user SET user_name='$user_name',user_full_name='$user_fname',user_password='$user_pswd',user_type='$user_type' WHERE user_id=$user_id";
		return  $this->conn->query($sql);
	}
	function deleteUser($id)
	{
		$sql="DELETE FROM tbl_user WHERE user_id=$id";
		return  $this->conn->query($sql);
	}
}//ending of the class
//creating the object
$objLms = new clsLMS();
?>