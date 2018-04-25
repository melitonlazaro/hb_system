<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Public/css/adminLTE.css">
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
		        <a class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
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
				<div class="row">
					<div class="col-md-4">
						<?php if($fr_count <= 10 && $fr_count >= 5){ ?>
							<div class="small-box bg-warning">
								<div class="inner">
									<h3>Flat Rate1</h3>
									<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }elseif($fr_count <= 4){ ?>
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>Flat Rate2</h3>
									<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }else{ ?>
							<div class="small-box bg-success">
								<div class="inner">
									<h3>Flat Rate3</h3>
									<h2><?php echo $fr_count; ?>/<?php echo $fr_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-md-4">
						<?php if($deluxe_count <= 8 && $deluxe_count >= 4){ ?>
							<div class="small-box bg-warning">
								<div class="inner">
									<h3>Flat Rate1</h3>
									<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }elseif($deluxe_count <= 3){ ?>
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>Flat Rate2</h3>
									<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }else{ ?>
							<div class="small-box bg-success">
								<div class="inner">
									<h3>Flat Rate3</h3>
									<h2><?php echo $deluxe_count; ?>/<?php echo $deluxe_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-md-4">
						<?php if($sd_count <= 5 && $sd_count >= 3){ ?>
							<div class="small-box bg-warning">
								<div class="inner">
									<h3>Flat Rate1</h3>
									<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }elseif($sd_count <= 2){ ?>
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>Flat Rate2</h3>
									<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php }else{ ?>
							<div class="small-box bg-success">
								<div class="inner">
									<h3>Flat Rate3</h3>
									<h2><?php echo $sd_count; ?>/<?php echo $sd_total; ?><p class="lead">Vacant Rooms</p></h2>
								</div>
								<div class="icon">
									<i class="fa fa-building"></i>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url();?>Public/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>Public/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>