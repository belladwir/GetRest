$(document).ready(function(){  
	load_data();

	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	}
	
	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});

	$("#room_dialog").dialog({
		autoOpen:false,
		width:400
	});

	//add reservasi
	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});

	//add room
	$('#addRoom').click(function(){
		$('#room_dialog').attr('title', 'Add Room');
		$('#action').val('insert');
		$('#submit_btn').val('Insert');
		$('#room_form')[0].reset();
		$('#submit_btn').attr('disabled', false);
		$("#room_dialog").dialog('open');
	});

	//Form Add Room
	$(document).on('click', '#submit_btn', function() {
        var name = $('#name').val();
        var capacity = $('#capacity').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        $.ajax({
            url: 'roomAction.php',
            type: 'POST',
            data: {
                'save': 1,
                'name': name,
                'capacity': capacity,
                'quantity': quantity,
                'price': price,
            },
            success: function(response) {
                $('#name').val('');
                $('#capacity').val('');
                $('#quantity').val('');
                $('#quantity').val('');
            }
        });
    });
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_name = '';
		var error_starts = '';
		var error_ends = '';
		var error_type = '';
		var error_persons = '';
		var error_rooms = '';
        //nama
		if($('#nama').val() == '')
		{
			error_name = 'Nama is required';
			$('#error_name').text(error_name);
			$('#nama').css('border-color', '#cc0000');
		}
		else
		{
			error_name = '';
			$('#error_name').text(error_name);
			$('#nama').css('border-color', '');
		}
        //start
		if($('#start').val() == '')
		{
			error_starts = 'Check In Date is required';
			$('#error_starts').text(error_starts);
			$('#start').css('border-color', '#cc0000');
		}
		else
		{
			error_starts = '';
			$('#error_starts').text(error_starts);
			$('#start').css('border-color', '');
		}
        //end
        if($('#end').val() == '')
		{
			error_ends = 'Check Out Date is required';
			$('#error_ends').text(error_ends);
			$('#end').css('border-color', '#cc0000');
		}
		else
		{
			error_ends = '';
			$('#error_ends').text(error_ends);
			$('#end').css('border-color', '');
		}
        //person
        if($('#persons').val() == '')
		{
			error_persons = 'Persons is required';
			$('#error_persons').text(error_persons);
			$('#persons').css('border-color', '#cc0000');
		}
		else
		{
			error_persons = '';
			$('#error_persons').text(error_persons);
			$('#persons').css('border-color', '');
		}
        //type
        if($('#type').val() == '')
		{
			error_type = 'Type Room is required';
			$('#error_type').text(error_type);
			$('#type').css('border-color', '#cc0000');
		}
		else
		{
			error_type = '';
			$('#error_type').text(error_type);
			$('#type').css('border-color', '');
		}
        //rooms
        if($('#rooms').val() == '')
		{
			error_rooms = 'Type Room is required';
			$('#error_rooms').text(error_rooms);
			$('#rooms').css('border-color', '#cc0000');
		}
		else
		{
			error_rooms = '';
			$('#error_rooms').text(error_rooms);
			$('#rooms').css('border-color', '');
		}
		
		if(error_name != '' || error_starts != '' || error_ends != '' || error_persons != '' || error_type != '' || error_rooms != '')
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});
	
	// $(document).on('click', '.edit', function(){
	// 	var id = $(this).attr('id');
	// 	var action = 'fetch_single';
	// 	$.ajax({
	// 		url:"action.php",
	// 		method:"POST",
	// 		data:{id:id, action:action},
	// 		dataType:"json",
	// 		success:function(data)
	// 		{
	// 			$('#nama').val(data.name);
	// 			$('#user_dialog').attr('title', 'Edit Data');
	// 			$('#action').val('update');
	// 			$('#hidden_id').val(id);
	// 			$('#form_action').val('Update');
	// 			$('#user_dialog').dialog('open');
	// 		}
	// 	});
    // });
    
    $('#checkout_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'update';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{
                        id:id,
                        action:action
                    },
					success:function(data)
					{
						$('#checkout_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr("id");
		$('#checkout_confirmation').data('id', id).dialog('open');
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{
                        id:id,
                        action:action
                    },
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"roomAction.php",
					method:"POST",
					data:{
                        id:id,
                        action:action
                    },
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.deleteRoom', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
    });
	
});

function tampilkan(halaman){
	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : 'http://localhost/gorest/content.php',
		//type pengiriman data POST, GET
		type     : 'POST',
		//Data yang akan di ambil oleh ajax
		dataType : 'html',
		//Variabel - variabel yang akan dikirimkan oleh AJAX
		data     : 'content='+halaman,
		success  : function(jawaban){
			//Jika request AJAX berhasil, maka DOM akan di isi dengan jawaban hasil Request
			$('#user_data').html(jawaban);
		},
	})
}