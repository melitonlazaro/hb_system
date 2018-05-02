<!DOCTYPE html>
<html>
<head>
	<title>
		Hotel Booking System
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Public/css/adminLTE.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
</head>
<body style="background-color: #696969;">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">HBS</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav mr-auto">
	      	<li class="nav-item active">
	        	<a class="nav-link" href="<?php echo base_url();?>Main/admin_dashboard">Dashboard<span class="sr-only">(current)</span></a>
	      	</li>
	      	<li class="nav-item">
	      		<?php if($this->session->userdata('account_type') === "Admin"){ ?>
	        		<a class="nav-link" href="<?php echo base_url();?>Main/room_prices_setting">Room Prices</a>
	        	<?php }
	        	else{

	        		} ?>
	      	</li>
	      	<li class="nav-item">
	        	<a class="nav-link" href="<?php echo base_url(); ?>Book">Accommodate</a>
	      	</li>
	      	<li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>Main/list_of_checkout">Checkout</a>
	      	</li>
	      	<li class="nav-item">
		      		<?php if($this->session->userdata('account_type') === "Admin") 
		      		{?>
			      		<a class="nav-link" href="<?php echo base_url();?>Main/activity_log"> Activity Log</a>	
			      	<?php }
			      	else
		    	  	{

		      		} ?>
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

	<br><br>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<h2><strong>Checkouts</strong></h2>
					<table id="table1" class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<td>Guest Name</td>
								<td>Room Type</td>
								<td>Room Number</td>
								<td>Adult</td>
								<td>Child</td>
								<td>Check-in Date</td>
								<td>Check-in Time</td>
								<td>Checkout Date</td>
								<td>Checkout Time</td>
								<td>Amount Paid</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($all_co as $ac) 
							{
								echo 
								'	
								<tr>
									<td>'.$ac->guest_name.'</td>
									<td>'.$ac->room_type.'</td>
									<td>'.$ac->room_id.'</td>
									<td>'.$ac->adult.'</td>
									<td>'.$ac->children.'</td>
									<td>'.$ac->check_in_date.'</td>
									<td>'.$ac->check_in_time.'</td>
									<td>'.$ac->checkout_date.'</td>
									<td>'.$ac->checkout_time.'</td>
									<td>'.$ac->total_price.'</td>
									<td>
										<a href="create_soa/'.$ac->checkout_id.'">
											<button class="btn btn-primary">Report</button>
										</a>
									</td>
								</tr>
								';
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</section>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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
</body>
</html>