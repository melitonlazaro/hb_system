<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<?php echo form_open('Main/login'); ?>
					<label>Username</label>
					<input type="text" name="username" class="form-control">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<br>
					<button type="submit" class="btn btn-info">Login</button>
				</form>
			</div>
		</div>	
	</div>
</body>
</html>