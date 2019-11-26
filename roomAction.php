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
		$cek_type_room = mysqli_nums_row("SELECT name FROM rooms where name = '".$_POST["name"]."'");
		if($cek_type_room != 0){
			$query = "
			INSERT INTO rooms (name, capacity, quantity, price) VALUES ('".$_POST["name"]."', '".$_POST["capacity"]."', '".$_POST["quantity"]."', '".$_POST["price"]."')";
		} else {
			$query = "UPDATE rooms SET quantity = '".$_POST["quantity"]."' where name = '".$_POST["name"]."'";
		}
		if (mysqli_query($conn, $query)) {
            echo '<p>Data Inserted...</p>';
          }else {
            echo "Error: ". mysqli_error($conn);
          }
	}

    if($_POST["action"] == "update")
	{
		$query = "UPDATE rooms SET status = 'CheckOut' WHERE id = '".$_POST["id"]."'";
		mysqli_query($conn, $query);
		echo '<p>The Passenger was Check Out</p>';
	}
    
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM rooms WHERE id = '".$_POST["id"]."'";
		mysqli_query($conn, $query);
		echo '<p>Room Deleted</p>';
	}
}

?>