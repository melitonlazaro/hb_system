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
		        	<a class="nav-link" href="<?php echo base_url();?>Main/room_prices_setting">Room Prices</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="<?php echo base_url(); ?>Book">Accommodate</a>
		      	</li>
		      	<li class="nav-item">
		      		<a class="nav-link" href="<?php echo base_url();?>Main/activity_log"> Activity Log</a>	
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
					<h2><strong>Activity Log</strong></h2><br>
					<div class="pull-right">
						<button class="btn btn-primary" data-toggle="modal" type="button" data-target="#ac_report_modal">Create Report</button>
						<!-- Modal button -->
					</div>	
						<!-- Activity Log report modal -->
						<div class="modal fade" id="ac_report_modal" tabindex="-1" role="dialog" aria-labelledby="ac_modal" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Activity Log Report</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12" style="border-bottom: 1px solid black;">
												<?php echo form_open('Main/activity_log_report_all') ?>
													<label>Generate Report for all Activity Log Records </label>
													<button type="submit" class="btn btn-primary">Generate Report</button>
												<?php echo form_close(); ?>
												<br>
											</div>
											<div class="col-md-12">
												<br>
												<label>Select Date Range</label>
												<?php echo form_open('Main/activity_log_selected_report'); ?>
													<label>From:</label>
													<input type="date" name="from_date" class="form-control" required>
													<label>To:</label>
													<input type="date" name="to_date" class="form-control" required>
													<br>
													<button class="btn btn-primary">Generate Report</button>
												<?php echo form_close(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<br><br>
					<table class="table table-hover table-striped" id="table1">
						<thead>
							<tr>
								<td>Activity Log</td>
								<td>Employee ID</td>
								<td>Employee Name</td>
								<td>Account Type</td>
								<td>Activity</td>
								<td>Activity ID</td>
								<td>Date</td>
								<td>Time</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($activity_log as $al)
								{
									echo 
									'
										<tr>
											<td>'.$al->log_id.'</td>
											<td>'.$al->employee_id.'</td>
											<td>'.$al->employee_name.'</td>
											<td>'.$al->account_type.'</td>
											<td>'.$al->activity.'</td>
											<td>'.$al->activity_id.'</td>
											<td>'.$al->date.'</td>
											<td>'.$al->time.'</td>
										</tr>
									';
								}
							?>
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