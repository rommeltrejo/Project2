<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Cancel Appointment</title>
 <link rel='stylesheet' type='text/css' href='../css/standard.css'/> 
 </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Cancel Appointment</h1>
	    <div class="field">
	    <?php
			$studid = $_SESSION["studID"];
			
			
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$oldAdvisorID = $row[2];
			$oldDatephp = strtotime($row[1]);				
				
			if($oldAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);					
				$oldAdvisorName = $row2[1] . " " . $row2[2];				
					$location = $row2[5];
					$office = $row2[6];

			}
			else{$oldAdvisorName = "Group";
			$location = "ITE 204";}	// set location for group

			
			echo "<h2>Current Appointment</h2>";
			echo "<label for='info'>";
			echo "Advisor: ", $oldAdvisorName, "<br>";
			echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "<br>";
			echo "Location: ", $location, "</br>";
			if($oldAdvisorID != 0){echo "Office: ", $office, "</label>";}else{echo  "</label>";}
		?>		
        </div>
	    <div class="finishButton">
			<form action = "StudProcessCancel.php" method = "post" name = "Cancel">
			<input type="submit" name="cancel" class="button large go" value="Cancel">
			<input type="submit" name="cancel" class="button large" value="Keep">
			</form>
	    </div>
		</div>
		<div class="bottom">
			<p>Click "Cancel" to cancel appointment. Click "Keep" to keep appointment.</p>
		</div>
		</form>
  <footer>
	<?php include("footer.html"); ?>
  </footer>
  </body>
</html>
