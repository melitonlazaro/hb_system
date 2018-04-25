<!DOCTYPE html>
<html>
<head>
	<title>
		Hotel Booking System
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
		        <a class="nav-link" href="#">Prices</a>
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
	
</body>
</html>