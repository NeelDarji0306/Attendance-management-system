<?php

//report.php

if(isset($_GET["action"]))
{
	require './checkValidity.php';
	require_once 'pdf.php';
	
	// $output = '';
	
	
	if($_GET["action"] == "clg_attendance_report")
	{
			// $pdf = new Pdf();
		// echo $_GET["from_date"]."<br>";
		// echo $_GET["to_date"]."<br>";
		// echo $_GET["dep"]."<br>";
		// echo $_GET["laborlec"]."<br>";
		// echo $_GET["sem"]."<br>";
		// echo $_GET["sub"]."<br>";
		// echo $_GET["tid"]."<br>";
		// echo $_GET["clgid"]."<br>";
		$from_date=$_GET["from_date"];
		$to_date=$_GET["to_date"];
		$dep=strtolower($_GET["dep"]);
		$laborlec=strtolower($_GET["laborlec"]);
		$sem=$_GET["sem"];
		$sub=strtolower($_GET["sub"]);
		// $tid=$_GET["tid"];
		$clgid=$_GET["clgid"];
		if(isset($_GET["from_date"], $_GET["to_date"]))
		{
			$pdf = new Pdf();
			// $query = "
			// SELECT attendance_date FROM tbl_attendance 
			// WHERE teacher_id = '".$_SESSION["teacher_id"]."' 
			// AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."')
			// GROUP BY attendance_date 
			// ORDER BY attendance_date ASC
			// ";
			$query = "
			SELECT * FROM collegeattendance 
			JOIN college ON collegeattendance.college_id=college.collegeId
			WHERE department='$dep' AND sem='$sem' AND subject='$sub' AND laborlec='$laborlec' AND college_id='$clgid'
			AND (date BETWEEN '$from_date' AND '$to_date')
			ORDER BY date ASC
			";

			
			$result = mysqli_query($conn,$query) or die("SQL Query Failed");
			
			$output = '
				<style>
				@page { margin: 20px; }
				tr.do-border td{
					border: 1px solid black
				}
				</style>
				<p>&nbsp;</p>
				<h3 align="center">Attendance Report</h3><br />';
			$count = 0;
			// print_r($result);
			foreach($result as $row)
			{
				$count= $count + 1;
				if($count<=1){
					$output.='

					<b>College - '.$row["collegeName"].'</b><br /><br />
					<b>Department - '.$row["department"].'</b><br /><br />
						<b>Subject - '.$row["subject"].'</b><br /><br />
						<b>Lab/Lec - '.$row["laborlec"].'</b><br /><br />';
				}
				$output .= '
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			        	<td><b>Date - '.$row["date"].'</b></td>
			        </tr>
			        <tr>
			        	<td>
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr class="do-border">
			        				<td><b>Student Name</b></td>
			        				<td><b>Roll Number</b></td>
			        				<td><b>Attendance Status</b></td>
			        			</tr>
				';
				$sub_query = "
				SELECT * FROM collegestudents 
			    JOIN users 
			    ON collegestudents.user_id = users.userId 
			    WHERE users.college_id = '$clgid' AND collegestudents.sem='$sem' AND collegestudents.branch='$dep' ORDER BY rollNumber ASC
				";
				
				$sub_result = mysqli_query($conn,$sub_query) or die("SQL Query Failed");
				foreach($sub_result as $sub_row)
				{
					$presentNos=$row['presentNumbers'];
					$status="";
					$presentNosArr = explode(", ",$presentNos);
					if (in_array($sub_row["rollNumber"], $presentNosArr)) {
						$status.= "present";
					} else {
						$status.= "absent";
					}
					$output .= '
					<tr class="do-border">
						<td >'.$sub_row["firstName"].' '.$sub_row["lastName"].'</td>
						<td >'.$sub_row["rollNumber"].'</td>
						<td >'.$status.'</td>
					</tr>
					';
				}
				$output .= '
					</table>
					</td>
					</tr>
				</table><br />
				';
			}
			// echo $output;
			
			if(mysqli_num_rows($result)==0){
				$file_name = 'Attendance Report.pdf';
				// $dompdf -> loadHtml($output);
				// $dompdf -> setPaper("A4", 'lnandscape');
				// $dompdf->render();
				// $dompdf->stream($file_name, array("Attachment" => false));
				$output.="<h4 align='center'>Attendance details for this subject in these period(".$_GET['from_date']." to ".$_GET['to_date'].") does not exist</h4>";
				$pdf -> loadHtml($output);
				$pdf -> setPaper("A4", 'lnandscape');
				$pdf->render();
				$pdf->stream($file_name, array("Attachment" => false));
				exit(0);
			} else{
				$file_name = 'Attendance Report.pdf';
				// $dompdf -> loadHtml($output);
				// $dompdf -> setPaper("A4", 'lnandscape');
				// $dompdf->render();
				// $dompdf->stream($file_name, array("Attachment" => false));
				$pdf -> loadHtml($output);
				$pdf -> setPaper("A4", 'lnandscape');
				$pdf->render();
				$pdf->stream($file_name, array("Attachment" => false));
				exit(0);
			}
		}
	}
	
	if($_GET["action"] == "schl_attendance_report")
	{
			// $pdf = new Pdf();
		// echo $_GET["from_date"]."<br>";
		// echo $_GET["to_date"]."<br>";
		// echo $_GET["std"]."<br>";
		// echo $_GET["sub"]."<br>";
		// echo $_GET["tid"]."<br>";
		// echo $_GET["schlid"]."<br>";
		$from_date=$_GET["from_date"];
		$to_date=$_GET["to_date"];
		$std=strtolower($_GET["std"]);
		$sub=strtolower($_GET["sub"]);
		// $tid=$_GET["tid"];
		$schlid=$_GET["schlid"];
		if(isset($_GET["from_date"], $_GET["to_date"]))
		{
			$pdf = new Pdf();
			// $query = "
			// SELECT attendance_date FROM tbl_attendance 
			// WHERE teacher_id = '".$_SESSION["teacher_id"]."' 
			// AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."')
			// GROUP BY attendance_date 
			// ORDER BY attendance_date ASC
			// ";
			$query = "
			SELECT * FROM schoolattendance 
			JOIN schoolname ON schoolattendance.schoolname_id=schoolname.schoolnameId
			WHERE standard='$std' AND subject='$sub' AND schoolname_id='$schlid'
			AND (date BETWEEN '$from_date' AND '$to_date')
			ORDER BY date ASC
			";

			
			$result = mysqli_query($conn,$query) or die("SQL Query Failed");
			
			$output = '
				<style>
				@page { margin: 20px; }
				tr.do-border td{
					border: 1px solid black
				}
				</style>
				<p>&nbsp;</p>
				<h3 align="center">Attendance Report</h3><br />';
			$countSchool = 0;
			// print_r($result);
			foreach($result as $row)
			{
				$countSchool= $countSchool + 1;
				if($countSchool<=1){
					$output.='

					<b>School - '.$row["schoolnameName"].'</b><br /><br />
					<b>Standard - '.$row["standard"].'</b><br /><br />
						<b>Subject - '.$row["subject"].'</b><br /><br />';
				}
				$output .= '
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			        	<td><b>Date - '.$row["date"].'</b></td>
			        </tr>
			        <tr>
			        	<td>
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr class="do-border">
			        				<td><b>Student Name</b></td>
			        				<td><b>Roll Number</b></td>
			        				<td><b>Attendance Status</b></td>
			        			</tr>
				';
				$sub_query = "
				SELECT * FROM schoolstudents 
			    JOIN users 
			    ON schoolstudents.user_id = users.userId 
			    WHERE users.schoolname_id = '$schlid' AND schoolstudents.standard='$std' ORDER BY rollNumber ASC
				";
				
				$sub_result = mysqli_query($conn,$sub_query) or die("SQL Query Failed");
				foreach($sub_result as $sub_row)
				{
					$presentNos=$row['presentNumbers'];
					$status="";
					$presentNosArr = explode(", ",$presentNos);
					if (in_array($sub_row["rollNumber"], $presentNosArr)) {
						$status.= "present";
					} else {
						$status.= "absent";
					}
					$output .= '
					<tr class="do-border">
						<td >'.$sub_row["firstName"].' '.$sub_row["lastName"].'</td>
						<td >'.$sub_row["rollNumber"].'</td>
						<td >'.$status.'</td>
					</tr>
					';
				}
				$output .= '
					</table>
					</td>
					</tr>
				</table><br />
				';
			}
			// echo $output;
			
			if(mysqli_num_rows($result)==0){
				$file_name = 'Attendance Report.pdf';
				// $dompdf -> loadHtml($output);
				// $dompdf -> setPaper("A4", 'lnandscape');
				// $dompdf->render();
				// $dompdf->stream($file_name, array("Attachment" => false));
				$output.="<h4 align='center'>Attendance details for this subject in these period(".$_GET['from_date']." to ".$_GET['to_date'].") does not exist</h4>";
				$pdf -> loadHtml($output);
				$pdf -> setPaper("A4", 'lnandscape');
				$pdf->render();
				$pdf->stream($file_name, array("Attachment" => false));
				exit(0);
			} else{
				$file_name = 'Attendance Report.pdf';
				// $dompdf -> loadHtml($output);
				// $dompdf -> setPaper("A4", 'lnandscape');
				// $dompdf->render();
				// $dompdf->stream($file_name, array("Attachment" => false));
				$pdf -> loadHtml($output);
				$pdf -> setPaper("A4", 'lnandscape');
				$pdf->render();
				$pdf->stream($file_name, array("Attachment" => false));
				exit(0);
			}
		}
	}


	// if($_GET["action"] == "student_report")
	// {
	// 	if(isset($_GET["student_id"], $_GET["from_date"], $_GET["to_date"]))
	// 	{
	// 		$pdf = new Pdf();
	// 		$query = "
	// 		SELECT * FROM tbl_student 
	// 		INNER JOIN tbl_grade 
	// 		ON tbl_grade.grade_id = tbl_student.student_grade_id 
	// 		WHERE tbl_student.student_id = '".$_GET["student_id"]."' 
	// 		";
	// 		$statement = $connect->prepare($query);
	// 		$statement->execute();
	// 		$result = $statement->fetchAll();
	// 		foreach($result as $row)
	// 		{
	// 			$output .= '
	// 			<style>
	// 			@page { margin: 20px; }
				
	// 			</style>
	// 			<p>&nbsp;</p>
	// 			<h3 align="center">Attendance Report</h3><br /><br />
	// 			<table width="100%" border="0" cellpadding="5" cellspacing="0">
	// 		        <tr>
	// 		            <td width="25%"><b>Student Name</b></td>
	// 		            <td width="75%">'.$row["student_name"].'</td>
	// 		        </tr>
	// 		        <tr>
	// 		            <td width="25%"><b>Roll Number</b></td>
	// 		            <td width="75%">'.$row["student_roll_number"].'</td>
	// 		        </tr>
	// 		        <tr>
	// 		            <td width="25%"><b>Grade</b></td>
	// 		            <td width="75%">'.$row["grade_name"].'</td>
	// 		        </tr>
	// 		        <tr>
	// 		        	<td colspan="2" height="5">
	// 		        		<h3 align="center">Attendance Details</h3>
	// 		        	</td>
	// 		        </tr>
	// 		        <tr>
	// 		        	<td colspan="2">
	// 		        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
	// 		        			<tr>
	// 		        				<td><b>Attendance Date</b></td>
	// 		        				<td><b>Attendance Status</b></td>
	// 		        			</tr>
	// 			';
	// 			$sub_query = "
	// 			SELECT * FROM tbl_attendance 
	// 			WHERE student_id = '".$_GET["student_id"]."' 
	// 			AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."') 
	// 			ORDER BY attendance_date ASC
	// 			";

	// 			$statement = $connect->prepare($sub_query);
	// 			$statement->execute();
	// 			$sub_result = $statement->fetchAll();
	// 			foreach($sub_result as $sub_row)
	// 			{
	// 				$output .= '
	// 				<tr>
	// 					<td>'.$sub_row["attendance_date"].'</td>
	// 					<td>'.$sub_row["attendance_status"].'</td>
	// 				</tr>
	// 				';
	// 			}
	// 			$output .= '
	// 					</table>
	// 				</td>
	// 				</tr>
	// 			</table>
	// 			';

	// 			$file_name = "Attendance Report.pdf";
	// 			$pdf->loadHtml($output);
	// 			$pdf->render();
	// 			$pdf->stream($file_name, array("Attachment" => false));
	// 			exit(0);
	// 		}
	// 	}
	// }
}

?>