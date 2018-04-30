<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Public/css/adminLTE.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">HBS</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		      	<?php if($this->session->userdata('account_type') === "Admin")
		      	{ ?>
		        	<a class="nav-link" href="<?php echo base_url();?>Main/admin_dashboard">Dashboard<span class="sr-only">(current)</span></a>
		      	<?php 
		      	}
		      	elseif($this->session->userdata('account_type') === "Employee"){ ?>
		        	<a class="nav-link" href="<?php echo base_url();?>Main/employee_dashboard">Dashboard<span class="sr-only">(current)</span></a>
		      	<?php 
		      	} ?>
		      </li>
		      <li class="nav-item">
		      	<?php if($this->session->userdata('account_type') === "Admin")
		      	{?>
		       		<a class="nav-link" href="<?php echo base_url();?>Main/room_prices_setting">Room Prices</a>
		       	<?php }
		       	else
		       	{

		       	} ?>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>Book">Accommodate</a>
		      </li>
		    </ul>
		    <ul class="navbar-nav">
		    	<li class="nav-item">
		    		<span class="navbar-text"> Signed in as: <?php echo $this->session->userdata('name');?> <small class="text-muted"> (<?php echo $this->session->userdata('account_type'); ?>)</small></span>
		    	</li>
		    </ul>
		    <ul class="navbar-nav">
		    	<li class="nav-item">
		    		<a href="<?php echo base_url();?>Main/logout"><button class="btn btn-outline-info my-2 my-sm-0">Logout</button></a>
		    	</li>
		    </ul>
		  </div>
	</nav>
	<br>
	<div class="container">
		<center>
			<div class="card" style="width: 40rem;" id="guest_option">
				<div class="card-header">
					<h2><strong>Hotel Booking System</strong></h2>
				</div>
				<div class="card-body">
					<?php 
					if($this->session->flashdata('taken_email'))
						{
							echo 
							'
								<div class="alert alert-warning">
									<p>'.$this->session->flashdata('taken_email').'</p>
								</div>
							';
						}
						elseif($this->session->flashdata('taken_email'))
						{
							echo 
							'
								<div class="alert alert-warning">
									<p>'.$this->session->flashdata('invalid_email').'</p>
								</div>
							';
						}
					?>
					<button class="btn btn-outline-primary btn-block" id="create_new">Create New Guest Profile</button>	
					<br>
					<button class="btn btn-outline-primary btn-block" id="choose_existing">Choose Existing Guest Profile</button>
				</div>
			</div>
		</center>
		<center>
			<div class="card" style="width: 40rem;" id="profiling_card">
				<div class="card-body">
					<div class="container">
						<div class="pull-left">
							<button class="btn btn-primary btn-sm" id="return_to_option1">Return</button>
						</div>
						<br><br>
						<?php echo validation_errors(); ?>
						<?php 
							echo form_open('Book/guest_profiling'); ?>
							<div class="pull-left">
								<strong>Guest Profiling</strong>
							</div>
							<br><br>
							<div class="row">
								<div class="col-md-3">
									<label>Last Name</label>
								</div>
								<div class="col-md-9">
									<input type="text" name="last_name" id="last_name" class="form-control" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label>First Name</label>
								</div>
								<div class="col-md-9">
									<input type="text" name="first_name" id="first_name" class="form-control" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label>Middle Initial</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="middle_initial" id="middle_initial" class="form-control" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label>Contact Number</label>
								</div>
								<div class="col-md-9">
									<input type="text" name="contact_number" id="contact_number" class="form-control" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label>Date of Birth</label>
								</div>
								<div class="col-md-9">
									<input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label>Email Address</label>
								</div>
								<div class="col-md-9">
									<input type="text" name="email" id="email" class="form-control" required>
								</div>
							</div>
							<br>
							<div class="pull-right">
								<button type="submit" id="profiling_btn" class="btn btn-outline-primary">Submit</button>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</center>
		<div class="card" id="guests_table">
			<div class="card-body">
				<div class="pull-left">
					<button class="btn btn-primary btn-sm" id="return_to_option2">Return</button>
				</div>
				<br><br>
				<h2>
					<strong>Guest List</strong>
				</h2>	
				<table id="table1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Guest ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Initial</th>
							<th>Contact Number</th>
							<th>Date of Birth</th>
							<th>Email</th>
							<th>Date Registered</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($guest_list as $gl)
							{	
								echo 
								'
									<tr>
										<td class="guest_id">'.$gl->guest_id.'</td>
										<td class="last_name"> '.$gl->last_name.'</td>
										<td class="first_name">'.$gl->first_name.' </td>
										<td class="middle_initial">'.$gl->middle_initial.'</td>
										<td class="contact_number">'.$gl->contact_number.'</td>
										<td class="date_of_birth">'.$gl->date_of_birth.'</td>
										<td class="email">'.$gl->email.'</td>
										<td>'.$gl->date_registered.'</td>
										<td><button class="btn btn-primary select_guest" >Select</button></td>
									</tr>
								';
							} 
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card" id="book_information">
			<div class="card-body">
				<?php echo form_open('Book/guest_accommodation'); ?>
					<h3><strong>Guest Information</strong></h3>
					<div class="row">
						<div class="col-md-5">
							<input type="hidden" name="guest_id" id="guest_id" >
							<label>First Name</label>
							<input type="text" name="guest_first_name" id="guest_first_name" value"" class="form-control" readonly>
						</div>
						<div class="col-md-5">
							<label>Last Name</label>
							<input type="text" name="guest_last_name" id="guest_last_name" value="" class="form-control" readonly>
						</div>
						<div class="col-md-2">
							<label>Middle Initial</label>
							<input type="text" name="guest_middle_initial" id="guest_middle_initial" value= "" class="form-control" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<label>Contact Number</label>
							<input type="text" name="guest_contact_number" id="guest_contact_number" value="" class="form-control" readonly>
						</div>
						<div class="col-md-5">
							<label>Email</label>
							<input type="text" name="guest_email" id="guest_email" value="" class="form-control" readonly>
						</div>
					</div>
					<br>
					<h3><strong>Book Information</strong></h3>
					<div class="row">
						<div class="col-md-4">
							<label>Room Type</label>
							<select name="room_type" id="room_type" class="form-control">
								<option>Select Room Type</option>
								<option value="flat_rate">Flat Rate</option>
								<option value="deluxe">Deluxe</option>
								<option value="super_deluxe">Super Deluxe</option>
							</select>
						</div>
						<div class="col-md-4">
							<label>Vacant Room</label>
							<select name="vacant_room" id="vacant_room" class="form-control">
								<option>Select Room</option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col">
							<label>Check-in Date</label>
							<?php $min_date = date('Y-m-d'); ?>
							<input type="date" name="checkin_date" min="<?php echo $min_date;?>" class="form-control">
						</div>
						<div class="col">
							<label>Check-in Time</label>
							<input type="time" name="checkin_time" class="form-control">
						</div>
						<div class="col">
							<label>Checkout Date</label>
							<input type="date" name="checkout_date" min="<?php echo $min_date;?>" class="form-control">
						</div>
						<div class="col">
							<label>Checkout Time</label>
							<?php 
								date_default_timezone_set('Asia/Manila');
								$time_today = date('H:00');
								$max_time = DateTime::createFromFormat('H:i', $time_today);
								$max_time-> add(new DateInterval('PT8H'));
								$max_checkout_time = $max_time->format('H:i');
								 ?>
							<input type="time" name="checkout_time" class="form-control" value="<?php echo $max_checkout_time; ?>">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3">
							<label>Adult Count</label>
							<input type="number" name="adult_count" class="form-control" min="0">
						</div>
						<div class="col-md-3">
							<label>Child Count</label>
							<input type="number" name="child_count" class="form-control" min="0">
						</div>
					</div>
					<div class="pull-right">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script>
	    $(function () {
	      $('#table1').DataTable({
	        buttons:[
	        {
	          text:'My Button'

	        }]
	      });
	    });
	</script>
	 <script type="text/javascript">
	 	$(document).ready(function(){
	 		$('#profiling_card').hide();
	 		$('#guests_table').hide();
	 		$('#book_information').hide();
	 	});
	 	$('#create_new').click(function(){
	 		$('#profiling_card').show();
	 		$('#guest_option').hide();
	 	});
	 	$('#choose_existing').click(function(){
	 		$('#guests_table').show();
	 		$('#guest_option').hide();
	 	});
	 	$('#return_to_option1').click(function(){
	 		$('#profiling_card').hide();
	 		$('#guest_option').show();
	 	});
	 	$("#return_to_option2").click(function(){
	 		$('#guests_table').hide();
	 		$('#guest_option').show();
	 	});
	 </script>

	 <script type="text/javascript">
	 	$('.select_guest').click(function(){
	 		var $col = $(this).closest("tr");
	 		var $last_name = $col.find(".last_name").text();
	 		var $col1 = $(this).closest("tr");
	 		var $first_name = $col1.find(".first_name").text();
	 		var $col2 = $(this).closest("tr");
	 		var $middle_initial = $col2.find(".middle_initial").text();
	 		var $col3 =  $(this).closest("tr");
	 		var $contact_number = $col3.find(".contact_number").text();
	 		var $col4 = $(this).closest("tr");
	 		var $email = $col4.find(".email").text();
	 		var $col5 = $(this).closest("tr");
	 		var $guest_id = $col5.find('.guest_id').text();

	 		
	 		$('#guest_first_name').val($first_name);
	 		$('#guest_last_name').val($last_name);
	 		$('#guest_middle_initial').val($middle_initial);
	 		$('#guest_contact_number').val($contact_number);
	 		$('#guest_email').val($email);
	 		$('#guest_id').val($guest_id);
	 		$('#book_information').show();
	 		$('#guests_table').hide();
			$('#guest_option').hide();
			
	 	});
	 </script>
	 <script>
		$(document).ready(function(){
		    $("#email").keyup(function(){
		        var email = $('#email').val();
		        $.ajax({
		        	type: "POST",
		        	url: "<?php echo site_url();?>Book/email_form_validation",
		        	data: {email:email},
		        	success:function(data)
		        	{
		        		if($data = 1)
		        		{
		        			console.log(data)
		        			$('#email').addClass("is-valid");
		        		}	
		        		else
		        		{
		        			console.log(data)
		        			$('#email').addClass("is-invalid");
		        		}
		        	}
		        });
		    });
		});
	</script>
	 <script type="text/javascript">
	 	$('#profiling_btn').click(function(event)
	 	{
	 		event.preventDefault();
	 		var first_name = $('#first_name').val();
	 		var last_name = $('#last_name').val();
	 		var middle_initial = $('#middle_initial').val();
	 		var contact_number = $('#contact_number').val();
	 		var date_of_birth = $('#date_of_birth').val();
	 		var email = $('#email').val();

	 		$.ajax({
	 			type: "POST",
	 			url: "<?php echo site_url(); ?>Book/guest_profiling",
	 			data: {first_name:first_name, last_name:last_name, middle_initial:middle_initial, contact_number:contact_number, date_of_birth:date_of_birth,  email:email},
	 			success:function(data)
	 			{
	 				alert("Success!")
	 				$('#book_information').show();
	 				$('#profiling_card').hide();
	 				$('#guests_table').hide();
	 				$('#guest_first_name').val(first_name);
	 				$('#guest_middle_initial').val(middle_initial);
	 				$('#guest_last_name').val(last_name);
	 				$('#guest_contact_number').val(contact_number);
	 				$('#guest_email').val(email);
	 				$('#guest_id').val(data);
	 			}
	 		});
	 	});
	 </script>
	<script type="text/javascript">
	 	$(document).ready(function(){
	 		$('#room_type').change(function(){
	 			var room_type = $(this).val();

	 			$.ajax({
	 				url: '<?php echo base_url();?>Book/get_vacant_room/',
	 				method: 'POST',
	 				data: {room_type: room_type},
	 				dataType: 'json',
	 				success:function(response){

	 					$('#vacant_room').find('option').not(':first').remove();
	 					$.each(response,function(key, data){
	 						$('#vacant_room').append('<option value="'+data['room_id']+'">Room '+data['room_id']+' </option>');
	 						// $('#price_per_hour').append('<input type="text" name="price_per_hour" id="price_per_hour" class="form-control" value="'+data['price_per_hour']+'" readonly>')
	 					});
	 				}
	 			});
	 		});
	 	});
	</script>
</body>
</html>