<?php
//action.php
$conn = mysqli_connect('localhost', 'root', '', 'gorest');
if (!$conn) {
  die('Connection failed ' . mysqli_error($conn));
}
if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO reservations (name, start, end, persons, total_room, id_room, status, pay, minus, paid_percentage) VALUES ('".$_POST["nama"]."', '".$_POST["start"]."', '".$_POST["end"]."', '".$_POST["persons"]."', '".$_POST["rooms"]."', '".$_POST["type"]."', 'CheckIn', 1000000, 0, 100)";
		if (mysqli_query($conn, $query)) {
            echo '<p>Data Inserted...</p>';
          }else {
            echo "Error: ". mysqli_error($conn);
          }
	}

    if($_POST["action"] == "update")
	{
		$query = "UPDATE reservations SET status = 'CheckOut' WHERE id = '".$_POST["id"]."'";
		mysqli_query($conn, $query);
		echo '<p>The Passenger was Check Out</p>';
	}
    
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM reservations WHERE id = '".$_POST["id"]."'";
		mysqli_query($conn, $query);
		echo '<p>Data Deleted</p>';
	}
}

?>