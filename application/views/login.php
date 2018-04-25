<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="container">
		<br><br><br><br><br>
		<div class="card" style="width: 40rem;">
			<div class="card-header">
				<center>
					<strong>Login</strong>
				</center>
			</div>
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