<?php
include("koneksi.php");
?>
<html>  
    <head>  
        <title>Get Rest</title>  
		<link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
		<script src="jquery.min.js"></script>  
		<script src="jquery-ui.js"></script>
		<script src="app.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Get Rest</a></h3><br />
			<br />
			<div align="right" style="margin-bottom:5px;">
            <button type="button" name="add" id="add" class="btn btn-success btn-xs ">Add</button>
            <button type="button" name="addRoom" id="addRoom" class="btn btn-success btn-xs">Add Room</button>
            <button type="button" name="menageRoom" id="menageReservasi" class="btn btn-primary btn-xs klik_menu" onclick="tampilkan('home');">Reservasi</button>
            <button type="button" name="menageRoom" id="menageRoom" class="btn btn-primary btn-xs klik_menu" onclick="tampilkan('room');">Menage Room</button>
			</div>
			<div class="table-responsive" id="user_data">
				
			</div>
			<br />
        </div>
		
		<div id="user_dialog" title="Add Data">
        <form method="post" id="user_form">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" id="nama" class="form-control" />
					<span id="error_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Check In</label>
					<input type="date" name="start" id="start" class="form-control" />
					<span id="error_starts" class="text-danger"></span>
				</div>
                <div class="form-group">
					<label>Check Out</label>
					<input type="date" name="end" id="end" class="form-control" />
					<span id="error_ends" class="text-danger"></span>
				</div>
                <div class="form-group">
					<label>Persons</label>
					<input type="number" name="persons" id="persons" class="form-control" />
					<span id="error_persons" class="text-danger"></span>
				</div>
                <div class="form-group">
					<label>Type</label>
					<select name="type">
                        <option>Choose One</option>
                        <?php
                            $query = "SELECT * FROM rooms where quantity != 0";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                    $output .= '
                                    <option value="'.$row['id'].'">'.$row['name'].'
                                    ';
                                }
                            $output .= '</option>';
                            echo $output;
                        ?>
                    </select>
					<span id="error_type" class="text-danger"></span>
				</div>
                <div class="form-group">
					<label>Room Book</label>
					<input type="number" name="rooms" id="rooms" class="form-control" />
					<span id="error_rooms" class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
        </div>

        <div id="room_dialog" title="Add Data">
            <form method="post" id="room_form">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                        <span id="error_capacity" class="text-danger"></span>
                    </div>
                        <span id="error_type" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control" />
                        <span id="error_capacity" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" />
                        <span id="error_quantity" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" id="price" class="form-control" />
                        <span id="error_price" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="action" id="action" value="insert" />
                        <input type="submit" id="submit_btn" name="form_action" class="btn btn-info" value="Insert" />
                    </div>
                </form>
		</div>
        
        <div id="edit_dialog" title="Edit Data">
            <form method="post" id="edit_form">
                    <div class="form-group">
                        <label>Name</label>
                        <select name="type">
                            <option>Choose One</option>
                            <?php
                                $query = "SELECT DISTINCT name, id FROM rooms";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                        $output .= '
                                        <option value="'.$row['name'].'">'.$row['name'].'
                                        ';
                                    }
                                $output .= '</option>';
                                echo $output;
                            ?>
                        </select>
                        <span id="error_type" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control" />
                        <span id="error_capacity" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" />
                        <span id="error_quantity" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" id="price" class="form-control" />
                        <span id="error_price" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="action" id="action" value="insert" />
                        <input type="submit" id="submit_btn" name="form_action" class="btn btn-info" value="Insert" />
                    </div>
                </form>
		</div>
		
		<div id="action_alert" title="Action">
			
		</div>
		
		<div id="delete_confirmation" title="Confirmation">
		<p>Are you sure you want to Delete this data?</p>
        </div>
        
        <div id="checkout_confirmation" title="Confirmation">
		<p>Are you sure guest was get out from their room?</p>
		</div>
    </body>  
</html>