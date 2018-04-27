<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Public/css/adminLTE.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<?php echo form_open('Book/test2') ?>
<!-- 	<input type="datetime-local" name="dt">
	<input type="datetime-local" name="dt2">
	<button type="submit">submit</button> -->

	<br><br><br>
<!-- 	<?php $strtime = "2018-04-25"; 
		  $endtime = "2018-04-28";

		  $result = $endtime - $strtime;
		  echo $result;
	?>
	<?php 
			$date1 = "2018-04-23 16:00";
			$date2 = "2018-04-26 12:00";

			$diff = abs(strtotime($date2) - strtotime($date1));

			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$hours = floor($diff - $years - $months - $days / 3600);
			printf("%d years, %d months, %d days\n", $years, $months, $days, $hours);
	 ?> -->

	<?php 
		$time_registered = '12:30'; 
		$date_checkout = date('Y-m-d');
		$time = DateTime::createFromFormat('H:i', $time_registered);
		$time->sub(new DateInterval('PT2H'));
		$timewarning = $time->format('H:i'); 
		echo "Time of Checkout: $time_registered <br>";
		echo "Time of Warning $timewarning";
		date_default_timezone_set('Asia/Manila');
		echo "<br>";
		$time_today = date('H:i:s');
		$date_today = date('Y-m-d');
		echo $date_today;
		echo "<br>";
		echo $time_today;
		echo "<br>";
		if($date_checkout === $date_today)
		{
			if($time_today >= $time_registered)	
			{
				echo "Overtime";
			}
			elseif($time_today >= $timewarning && $time_today < $time_registered)
				{
					echo '<div class="alert alert-warning">
							Upcoming Check out Room Number: 123123 .
						 </div>
					';
				}
			else
			{
				echo "No checkout as of now.";
			}
		}
		else
		{
			echo "No checkout for today.";
		}
	?>

	<?php 
		$datetime1 = new DateTime('2018-04-25 16:00');
		$datetime2 = new DateTime('2018-04-27 13:00');
		$interval = $datetime1->diff($datetime2);
		$hours = $interval->h;
		$hours = $hours + ($interval->days*24);
		echo "$hours hours";
		echo "<br>";
		$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		echo $elapsed;
	?>
</body>
</html>