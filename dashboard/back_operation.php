<?php
include('../db/inc_db.php');
$operation=$_POST['operation'];
if($operation=='r')
{
	?>
	  <div class="col-md-2 text-center">
	        <a href="../book/">
	        <div class="stats-box border-1 pad-20">
	        <h3>
			<?php
				//code to get all the books count from the table.
				 $objLms->getAllBooksCount();
			?>
			</h3>
	        <h5>Books Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="../author/">
	        <div class="stats-box border-1 pad-20">
	        <h3>
			<?php
				//code to get all the books count from the table.
				 $objLms->getAllAuthorsCount();
			?>
			</h3>
	        <h5>Authors Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="../publisher/">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllPublishersCount(); ?></h3>
	        <h5>Publishers Available</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="../student/">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllStudentCount(); ?></h3>
	        <h5>Students Count</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="../class/">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllClassCount(); ?></h3>
	        <h5>Classes In College</h5>
	        </div>
	        </a>
	    </div>
	    <div class="col-md-2 text-center">
	        <a href="../issue/">
	        <div class="stats-box border-1 pad-20">
	        <h3><?php $objLms->getAllIssueCount(); ?></h3>
	        <h5>Books Issued until Now</h5>
	        </div>
	        </a>
	    </div>
<?php } 
 ?>