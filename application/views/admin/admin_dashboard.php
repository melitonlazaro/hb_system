<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System</title>
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

	<section class="content">
		<div class="container-fluid">
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="pull-right">
								<div class="dropdown">
								  <button class="btn btn-outline-info btn-large dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Notifications <span class="badge badge-dark"><?php echo count($co_details) ?></span>
								  </button>
								  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								  		<?php 
								  		date_default_timezone_set('Asia/Manila');
										$date_today_notif = date('Y-m-d');
										$time_today_notif = date('H:i'); 
										foreach ($co_details as $co) 
										{
											$checkout_time_warning_notif = $co->checkout_time;
											$warning_time_notif = DateTime::createFromFormat('H:i', $checkout_time_warning_notif);
											$warning_time_notif-> sub(new DateInterval('PT2H'));
											$co_warning_time_notif = $warning_time_notif->format('H:i');
											if($date_today_notif === $co->checkout_date)
											{
												if($time_today_notif >= $co->checkout_time)
												{
													echo 
													'
														<p class="text-danger"> 
															Room '.$co->room_id.' ('.$co->guest_name.') : OVERTIME '.$co->checkout_time.'.
														</p> 
													';
												}
												elseif($time_today_notif >= $co_warning_time_notif && $time_today_notif < $co->checkout_time)
												{
													echo 
													'
														<p class="text-warning">
															Room '.$co->room_id.' ('.$co->guest_name.'): Will checkout at '.$co->checkout_time.'.
														</p>
													';
												}
											}
											else
											{
												echo "No checkout for today.";
											}
										}
										?>
								  	</div>
								</div>
							</div>
							<br><br><br>
							<div class="row">
								<div class="col-md-4">
									<?php if($fr_count <= 10 && $fr_count >= 5){ ?>
										<div class="small-box bg-warning">
											<div class="inner">
												<h3>Flat Rate</h3>
												<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }elseif($fr_count <= 4){ ?>
										<div class="small-box bg-danger">
											<div class="inner">
												<h3>Flat Rate</h3>
												<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }else{ ?>
										<div class="small-box bg-success">
											<div class="inner">
												<h3>Flat Rate</h3>
												<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="col-md-8">
									<div class="row">
										<?php foreach($fr_details as $frd)
											{
												echo 
												'
													<div class="col-md-3">';
													if($frd->availability === "Available")
													{
														echo '<div class="info-box bg-dark-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-square-o"></i></span>';
													}elseif($frd->availability === "Occupied")
													{
														echo '<div class="info-box bg-light-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>';
													}
													echo '
															<div class="info-box-content">
																<span class="info-box-text">Rm. '.$frd->room_id.'</span>
																<span class="info-box-text">'.$frd->availability.'</span>
															</div>
														</div>
													</div>
												';
											}
										?>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<?php if($deluxe_count <= 8 && $deluxe_count >= 4){ ?>
										<div class="small-box bg-warning">
											<div class="inner">
												<h3>Deluxe</h3>
												<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }elseif($deluxe_count <= 3){ ?>
										<div class="small-box bg-danger">
											<div class="inner">
												<h3>Deluxe</h3>
												<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }else{ ?>
										<div class="small-box bg-success">
											<div class="inner">
												<h3>Deluxe</h3>
												<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="col-md-8">
									<div class="row">
										<?php foreach($deluxe_details as $dld)
											{
												echo 
												'
													<div class="col-md-3">';
													if($dld->availability === "Available")
													{
														echo '<div class="info-box bg-dark-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-square-o"></i></span>';
													}elseif($dld->availability === "Occupied")
													{
														echo '<div class="info-box bg-light-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>';
													}
													echo '
															<div class="info-box-content">
																<span class="info-box-text">Rm. '.$dld->room_id.'</span>
																<span class="info-box-text">'.$dld->availability.'</span>
															</div>
														</div>
													</div>
												';
											}
										?>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<?php if($sd_count <= 5 && $sd_count >= 3){ ?>
										<div class="small-box bg-warning">
											<div class="inner">
												<h3>Super Deluxe</h3>
												<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }elseif($sd_count <= 2){ ?>
										<div class="small-box bg-danger">
											<div class="inner">
												<h3>Super Deluxe</h3>
												<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php }else{ ?>
										<div class="small-box bg-success">
											<div class="inner">
												<h3>Super Deluxe</h3>
												<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
											</div>
											<div class="icon">
												<i class="fa fa-building"></i>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="col-md-8">
									<div class="row">
										<?php foreach($sd_details as $sdd)
											{
												echo 
												'
													<div class="col-md-3">';
													if($sdd->availability === "Available")
													{
														echo '<div class="info-box bg-dark-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-square-o"></i></span>';
													}elseif($sdd->availability === "Occupied")
													{
														echo '<div class="info-box bg-light-gradient">';
														echo '<span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>';
													}
													echo '
															<div class="info-box-content">
																<span class="info-box-text">Rm. '.$sdd->room_id.'</span>
																<span class="info-box-text">'.$sdd->availability.'</span>
															</div>
														</div>
													</div>
												';
											}
										?>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="card">
					<div class="card-body">
						<div class="col-md-12">
							<h2><strong>Accommodations</strong></h2>
							<br>
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Guest</th>
										<th>Room Type</th>
										<th>Room Number</th>
										<th>Price/hour</th>
										<th>Check-in Date</th>
										<th>Check-in Time</th>
										<th>Checkout Date</th>
										<th>Checkout Time</th>
										<th>Adult</th>
										<th>Children</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									date_default_timezone_set('Asia/Manila');
									$date_today = date('Y-m-d');
									$time_today = date('H:i');
									foreach ($accommodation as $ac) 
									{
										$checkout_time_warning = $ac->checkout_time;
										$warning_time = DateTime::createFromFormat('H:i', $checkout_time_warning);
										$warning_time->sub(new DateInterval('PT2H'));
										$co_warning_time = $warning_time->format('H:i');
										if($ac->checkout_date === $date_today)
										{
											if($time_today >= $ac->checkout_time)
											{
												echo 
												'
													<tr class="table-danger">
												';
											}
											elseif($time_today >= $co_warning_time && $time_today < $ac->checkout_time)
											{
												echo 
												'
													<tr class="table-warning">
												';
											}
										}
										else
										{
											echo 
											'
												<tr>
											';
										}
										echo '
												<td> '.$ac->guest_name.' </td>
												<td> '.$ac->room_type.' </td>
												<td> '.$ac->room_id.' </td>
												<td> '.$ac->price_per_hour.' </td>
												<td> '.$ac->check_in_date.' </td>
												<td> '.$ac->check_in_time.' </td>
												<td> '.$ac->checkout_date.' </td>
												<td> '.$ac->checkout_time.' </td>
												<td> '.$ac->adult.' </td>
												<td> '.$ac->children.' </td>
												<td>
													<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#checkout_modal'.$ac->accommodation_id.'" ><i class="fa fa-sign-out"></i> Checkout</button>

												</td>';
										echo'
												<div class="modal fade" id="checkout_modal'.$ac->accommodation_id.'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">Checkout</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											         				<span aria-hidden="true">&times;</span>
												        		</button>
															</div>';
										echo form_open('Book/checkout');
										echo '
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12">
																		<label>Guest Name</label>
																		<input type="hidden" name="accommodation_id" value="'.$ac->accommodation_id.'">
																		<input type="text" name="acc_guest_name" value="'.$ac->guest_name.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Room Number</label>
																		<input type="text" name="acc_room_id" value="'.$ac->room_id.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Room Type </label>
																		<input type="text" name="acc_room_type" value="'.$ac->room_type.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Adult </label>
																		<input type="text" name="acc_adult" value="'.$ac->adult.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Children</label>
																		<input type="text" name="acc_children" value="'.$ac->children.'" class="form-control" readonly> 
																	</div>
																	<div class="col-md-6"> 
																		<label>Check-in Date </label>
																		<input type="text" name="acc_ci_date" value="'.$ac->check_in_date.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Check-in Time</label>
																		<input type="text" name="acc_ci_time" value="'.$ac->check_in_time.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6"> 
																		<label>Checkout Date </label>
																		<input type="text" name="acc_co_date" value="'.$ac->checkout_date.'" class="form-control" readonly>
																	</div>
																	<div class="col-md-6">
																		<label>Checkout Time</label>
																		<input type="text" name="acc_co_time" value="'.$ac->checkout_time.'" class="form-control" readonly>
																	</div>
																	<br><br>';
																	$combined_ci = $ac->check_in_date.' '.$ac->check_in_time; //combined date and time of check-in
																	$combined_co = $ac->checkout_date.' '.$ac->checkout_time; //combined date and time of checkout
																	$ci_hours = new DateTime($combined_ci);
																	$co_hours = new DateTime($combined_co);
																	$interval = $ci_hours->diff($co_hours);
																	$total_hours = $interval->h;
																	$total_hours = $total_hours + ($interval->days*24); //converts number of days into hours
																	// echo $total_hours;
																	$total_price = $total_hours * $ac->price_per_hour;
										echo
										'							
																	<div class="col-md-12 text-right">
																		<label>Total Payment </label>
																			<p>Number of hours: <strong> '.$total_hours.' </strong> * Price per hour: <strong> '.$ac->price_per_hour.' </strong></p>
																		<div class="pull-right">
																			<div class="input-group">
																				<div class="input-group-text">P</div>
																				<input type="text" class="form-control-lg" value="'.$total_price.'" readonly>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
																<button type="submit" class="btn btn-info">Submit</button> 
															</div>
														</div>
													</div>
												</div>
											</tr>
										';
										echo form_close();
									} 
									?>
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br><br>
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