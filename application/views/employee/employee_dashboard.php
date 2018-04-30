<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Public/css/adminLTE.css">
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
		        <a class="nav-link" href="<?php echo base_url();?>Main/employee_dashboard">Dashboard<span class="sr-only">(current)</span></a>
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
	<br><br>
	<div class="container-fluid">
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
				<br><br>
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
						<br><br>
						<div class="row">
							<?php foreach($fr_details as $frd)
								{
									echo 
									'
										<div class="col">';
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
					<div class="col-md-4">
						<?php if($deluxe_count <= 8 && $deluxe_count >= 4){ ?>
							<div class="small-box bg-warning">
								<div class="inner">
									<h3>Deluxe1</h3>
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
						<br><br>
						<div class="row">
							<?php foreach($deluxe_details as $dd)
								{
									echo 
									'
										<div class="col">';
										if($dd->availability === "Available")
										{
											echo '<div class="info-box bg-dark-gradient">';
											echo '<span class="info-box-icon"><i class="fa fa-square-o"></i></span>';
										}elseif($dd->availability === "Occupied")
										{
											echo '<div class="info-box bg-light-gradient">';
											echo '<span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>';
										}
										echo '
												<div class="info-box-content">
													<span class="info-box-text">Rm. '.$dd->room_id.'</span>
													<span class="info-box-text">'.$dd->availability.'</span>
												</div>
											</div>
										</div>
									';
								}
							?>
						</div>
					</div>
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
						<br><br>
						<div class="row">
							<?php foreach($sd_details as $sdd)
								{
									echo 
									'
										<div class="col">';
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>