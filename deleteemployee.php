<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Employee</title>
</head>

<body>
	<h2>Delete an Employee Record</h2>
	<hr>
	<?php
		echo "<h3>PHP Code Generates This:</h3>";
		
		//some variables
		$servername = "localhost";  //mysql is on the same host as apache (not realistic) this would more likely be an IP address
		$username = "iggi";    //username for database
		$password = "1544";		//password for the user
		$dbname = "employees";  	//which db you're going to use
	
		//this is the php object oriented style of creating a mysql connection
		$conn = new mysqli($servername, $username, $password, $dbname);  
	
		//check for connection success
		if ($conn->connect_error) {
			die("MySQL Connection Failed: " . $conn->connect_error);
		}
		echo "MySQL Connection Succeeded<br><br>";
		
		//pull the attribute that was passed with the html form GET request and put into a local variable.
		$emp_no = $_GET["emp_no"];
		echo "Searching for employee: " . $emp_no;
	
		echo "<br><br>";
		
		//create the SQL select statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		$sql = "SELECT first_name,last_name FROM employees where emp_no = '".$emp_no."'";
        $delete = "DELETE FROM employees WHERE emp_no = '".$emp_no."'";//deletion sql command
	
		//put the resultset into a variable, again object oriented way of doing things here
		$result = $conn->query($sql);

	
		//if there were no records found say so, otherwise create a while loop that loops through all rows
		//and echos each line to the screen. You do this by creating some crazy looking echo statements
		// in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
		// the dot "." is PHP's string concatenator operator
	    echo "<table style=\"width:25%\">";
        echo"<hr>";
		if ($result->num_rows > 0){
			//print rows
            echo "Deleting employee:";
			while($row = $result->fetch_assoc()){
				echo "<tr><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td></tr>";
                $conn->query($delete);   
                echo"<br>";
                echo"Employee was successfully removed.";
			}
		} else {
			echo "Employee not found.";
		}
		echo "</table>";
        echo "<br>";
		//always close the DB connections, don't leave 'em hanging
		$conn->close();
		
	?>
</body>
</html>