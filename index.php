<html>
	<h3>Blind SQL Injection Practice<h3>

<?php

if(isset($_GET['q'])) {

}

$servername = "localhost";
$username = "poon";
$password = "noop";

#CREATE USER 'poon'@'localhost' IDENTIFIED BY 'noop';
#GRANT ALL PRIVILEGES ON * . * TO 'poon'@'localhost';
#FLUSH PRIVILEGES

$conn = new mysqli($servername, $username, $password);

if(!$conn) {
	die("<div>Connection Status: Failed!: </div>");
}
echo "<div>Connection Status: Connected!</div>";

/**Initiate SQL Stuff below here! **/

if($_GET['q']) {
	$q = $_GET['q'];
	$conn = new mysqli($servername, $username, $password, 'opon');
	$sql = "SELECT * FROM Poonifacts WHERE firstname LIKE '%%$q%%'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		}
	} else {
	           echo "0 results";
	}
	$conn->close();
}

if($_GET['i'] == 1) {
	$sql = "CREATE DATABASE opon";
	if($conn->query($sql) === TRUE) {
		echo "<div>Successfully created database</div>";
	} else {
		echo "Error creating database";
	}

	$conn = new mysqli($servername, $username, $password, 'opon');

	$sql = "CREATE TABLE Poonifacts (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	if($conn->query($sql) === TRUE) {
		echo "<div>Successfully created table!</div>";
	} else {
		echo "Error creating the table!";
	}

	$sql = "INSERT INTO Poonifacts (firstname, lastname, email)
		VALUES ('John', 'Poe', 'john.poe@poemail.com')";
	if($conn->query($sql) === TRUE) {
		echo "<div>Successfully added an entry</div>";
	} else {
		echo "<div>Error adding table</div>";
	}
}


?>

</html>
