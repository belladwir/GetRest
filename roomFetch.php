<?php
$conn = mysqli_connect('localhost', 'root', '', 'gorest');
if (!$conn) {
  die('Connection failed ' . mysqli_error($conn));
}
//fetch.php
$sql = "SELECT * FROM rooms";
$result = mysqli_query($conn, $sql);
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Nama</th>
		<th>Capacity</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
';
while ($row = mysqli_fetch_array($result)) {
    if($row > 0){
		$output .= '
		<tr>
			<td width="40%">'.$row["id"].'</td>
			<td width="40%">'.$row["name"].'</td>
			<td width="40%">'.$row["capacity"].'</td>
			<td width="40%">'.$row["quantity"].'</td>
			<td width="40%">'.$row["price"].'</td>
			<td width="10%">
				<button type="button" name="editRoom" class="btn btn-primary btn-xs editRoom" id="'.$row["id"].'">Edit</button>
			</td>
			<td width="10%">
				<button type="button" name="deleteRoom" class="btn btn-danger btn-xs deleteRoom" id="'.$row["id"].'">Delete</button>
			</td>
		</tr>
		';
	}
else
{
	$output .= '
	<tr>
		<td colspan="8" align="center">Data not found</td>
	</tr>
	';
}
}
$output .= '</table>';
echo $output;
?>