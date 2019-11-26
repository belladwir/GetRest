<?php
$conn = mysqli_connect('localhost', 'root', '', 'gorest');
if (!$conn) {
  die('Connection failed ' . mysqli_error($conn));
}
//fetch.php
$sql = "SELECT * FROM reservations where status = 'CheckIn'";
$result = mysqli_query($conn, $sql);
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Nama</th>
		<th>Check In</th>
		<th>Check Out</th>
		<th>Status</th>
		<th>Paid</th>
		<th>Check Out</th>
		<th>Delete</th>
	</tr>
';
while ($row = mysqli_fetch_array($result)) {
    if($row > 0){
		$output .= '
		<tr>
			<td width="40%">'.$row["id"].'</td>
			<td width="40%">'.$row["name"].'</td>
			<td width="40%">'.$row["start"].'</td>
			<td width="40%">'.$row["end"].'</td>
			<td width="40%">'.$row["status"].'</td>
			<td width="40%">'.$row["paid_percentage"].' %</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Check Out</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>
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