<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Employee</title>
</head>

<body>
	<h2>Update an Employee Record</h2>
	<hr>
	<?php
		echo "<h3>PHP Code Generates This:</h3>";
		
		//some variables
		$servername = "192.168.1.116";  
		$username = "iggi";    //username for database
		$password = "1544";		//password for the user
		$dbname = "employees";  	//which db you're going to use
	
		//this is the php object oriented style of creating a mysql connection
		$conn = new mysqli($servername, $username, $password, $dbname);  
	
		//check for connection success
		if ($conn->connect_error) {
			die("MySQL Connection Failed: " . $conn->connect_error);
		}
		$lastname = $_GET["lastname"];
		$firstname = $_GET["firstname"];
		$number = $_GET["number"];
		$gender = $_GET["gender"];
		$hiredate = $_GET["hiredate"];
		$birthdate = $_GET["birthdate"];

		//simple out context for users
		echo "MySQL Connection Succeeded<br><br>";

		echo "Updating employee: " . $firstname . " " . $lastname . ". Employee number:" . $number;
		echo "<table style=\"width:70%\">";
		echo "<tr><td><strong>Employee Number</strong></td><td><strong>Birth Date</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Gender</strong></td><td><strong>Hire Date</strong></td></tr>";

		echo "<br><br>";
		//sql select statement
        $sql = "SELECT emp_no,birth_date,first_name,last_name,gender,hire_date FROM employees where emp_no = '".$number."'";
        $result = $conn->query($sql);
		//sql statements for updating select areas of an element
		$update_birth = "UPDATE employees SET birth_date = '".$birthdate."' WHERE emp_no = '".$number."'";
		$update_First = "UPDATE employees SET first_name = '".$firstname."' WHERE emp_no = '".$number."'";
		$update_Last = "UPDATE employees SET last_name = '".$lastname."' WHERE emp_no = '".$number."'";
		$update_gender = "UPDATE employees SET gender = '".$gender."' WHERE emp_no = '".$number."'";
		$update_hire = "UPDATE employees SET hire_date = '".$hiredate."' WHERE emp_no = '".$number."'";

		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<tr><td>" . $row["emp_no"]. "</td><td>" . $row["birth_date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["hire_date"]. "</td></tr>";
			}
			if ($lastname != null) {
				$conn->query($update_Last);
			}
			if ($firstname != null) {
				$conn->query($update_First);
			}
			if ($gender != null) {
				$conn->query($update_gender);
			}
			if ($hiredate != null) {
				$conn->query($update_hire);
			}
			if ($birthdate != null) {
				$conn->query($update_birth);
			}
	
			
		} else {

			echo "Employee not found!";
			
		}


		//check for who got update and to what.
		$result = $conn->query($sql);
	
		echo "<tr><td><strong>Employee Number</strong></td><td><strong>Birth Date</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Gender</strong></td><td><strong>Hire Date</strong></td></tr>";
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<tr><td>" . $row["emp_no"]. "</td><td>" . $row["birth_date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["hire_date"]. "</td></tr>";
				}
			} else {
				echo "No Records Found";
			}
	
		//always close the DB connections, don't leave 'em hanging
		$conn->close();
		
	?>
</body>
</html>