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
<body style="background-color: #696969;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">HBS</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav mr-auto">
		      	<li class="nav-item active">
		        	<a class="nav-link" href="<?php echo base_url();?>Main/admin_dashboard?>">Dashboard<span class="sr-only">(current)</span></a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="<?php echo base_url();?>Main/room_prices_setting ?>">Room Prices</a>
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

	<section class="content">
		<div class="container-fluid">
			<br>
			<div class="card">
				<div class="card-body">

					<?php if($this->session->flashdata('price_update'))
							{
								echo 
								'
									<div class="container">
										<div class="alert alert-success alert-dismissable fade show" role="alert">
								';
								echo $this->session->flashdata('price_update');
								echo '	
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    		<span aria-hidden="true">&times;</span>
								 	</button>
										</div>
									</div>
								';
							}
					 ?>
					<div class="row">
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<div class="card-header">
										<div class="card-title">
											<strong>Flat Rate</strong>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-hover">
												<tr>
													<td>Room type</td>
													<td>Flat Rate</td>
												<tr>
													<td>Price per hour</td>
													<td><strong><?php echo $fr_price[0]->price_per_hour;?></strong></td>
												<tr>
													<td>Number of rooms</td>
													<td><?php echo count($fr_price); ?></td>
												</tr>
										</table>
										<br>
										<div class="pull-right">
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#fr_edit">
											  Change room price
											</button>

											<!-- Modal -->
											<div class="modal fade" id="fr_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
											  	<div class="modal-dialog" role="document">
											    	<div class="modal-content">
											      		<div class="modal-header">
											        		<h5 class="modal-title" id="exampleModalLongTitle">Change Price</h5>
											        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											         			<span aria-hidden="true">&times;</span>
											        		</button>
											      		</div>
											      		<div class="modal-body">
											       			<div class="row">
											        			<div class="col">
											        				<table class="table table-hover">
											        					<tr>
													        				<td>Room Type</td>
													        				<td>Flat Rate</td>
											        					</tr>
													        			<tr>
													        				<td>Number of Rooms</td>
													        				<td><?php echo count($fr_price); ?></td>
											        					</tr>
											        					<tr>
													        				<td>Price per hour</td>
													        				<td>
														        				<?php echo form_open('Book/change_room_price'); ?>
														        					<input type="hidden" name="room_type" value="flat_rate">
														        					<div class="input-group mb-2">
																				        <div class="input-group-prepend">
																				          <div class="input-group-text">P</div>
																				        </div>
														        							<input type="number" name="price_per_hour" value="<?php echo $fr_price[0]->price_per_hour; ?>" class="form-control" required>
																				    </div> 
														        			</td>
											        					</tr>
											        				</table>
									        							<div class="pull-right">
																		    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											       								<button type="submit" class="btn btn-primary">Save changes</button>
																	    </div>
																			    </form>
											        			</div>
											        		</div>
											     		</div>
											   		</div>
										  		</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<div class="card-header">
										<div class="card-title">
											<strong>Deluxe</strong>
										</div>	
									</div>
									<div class="card-body">
										<table class="table table-hover">
												<tr>
													<td>Room type</td>
													<td>Deluxe</td>
												<tr>
													<td>Price per hour</td>
													<td><strong><?php echo $deluxe_price[0]->price_per_hour; ?></strong></td>
												<tr>
													<td>Number of rooms</td>
													<td><?php echo count($deluxe_price); ?></td>
												</tr>
										</table>
										<br>
										<div class="pull-right">
											<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#deluxe_edit">
											  Change room price
											</button>

											<!-- Modal -->
											<div class="modal fade" id="deluxe_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
											  	<div class="modal-dialog" role="document">
											    	<div class="modal-content">
											      		<div class="modal-header">
											        		<h5 class="modal-title" id="exampleModalLongTitle">Change Price</h5>
											        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											         			<span aria-hidden="true">&times;</span>
											        		</button>
											      		</div>
											      		<div class="modal-body">
											       			<div class="row">
											        			<div class="col">
											        				<table class="table table-hover">
											        					<tr>
													        				<td>Room Type</td>
													        				<td>Deluxe</td>
											        					</tr>
													        			<tr>
													        				<td>Number of Rooms</td>
													        				<td><?php echo count($deluxe_price); ?></td>
											        					</tr>
											        					<tr>
													        				<td>Price per hour</td>
													        				<td>
														        				<?php echo form_open('Book/change_room_price'); ?>
														        					<input type="hidden" name="room_type" value="deluxe">
														        					<div class="input-group mb-2">
																				        <div class="input-group-prepend">
																				          <div class="input-group-text">P</div>
																				        </div>
														        							<input type="number" name="price_per_hour" value="<?php echo $deluxe_price[0]->price_per_hour; ?>" class="form-control" required>
																				    </div> 
														        			</td>
											        					</tr>
											        				</table>
									        							<div class="pull-right">
																		    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											       								<button type="submit" class="btn btn-primary">Save changes</button>
																	    </div>
																			    </form>
											        			</div>
											        		</div>
											     		</div>
											   		</div>
										  		</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<div class="card-header">
										<div class="card-title">
											<strong>Super Deluxe</strong>
										</div>	
									</div>
									<div class="card-body">
										<table class="table table-hover">
												<tr>
													<td>Room type</td>
													<td>Super Deluxe</td>
												<tr>
													<td>Price per hour</td>
													<td><strong><?php echo $sd_price[0]->price_per_hour; ?></strong></td>
												<tr>
													<td>Number of rooms</td>
													<td><?php echo count($sd_price); ?></td>
												</tr>
										</table>
										<br>
										<div class="pull-right">
											<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#sd_edit">
											  Change room price
											</button>

											<!-- Modal -->
											<div class="modal fade" id="sd_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
											  	<div class="modal-dialog" role="document">
											    	<div class="modal-content">
											      		<div class="modal-header">
											        		<h5 class="modal-title" id="exampleModalLongTitle">Change Price</h5>
											        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											         			<span aria-hidden="true">&times;</span>
											        		</button>
											      		</div>
											      		<div class="modal-body">
											       			<div class="row">
											        			<div class="col">
											        				<table class="table table-hover">
											        					<tr>
													        				<td>Room Type</td>
													        				<td>Super Deluxe</td>
											        					</tr>
													        			<tr>
													        				<td>Number of Rooms</td>
													        				<td><?php echo count($sd_price); ?></td>
											        					</tr>
											        					<tr>
													        				<td>Price per hour</td>
													        				<td>
														        				<?php echo form_open('Book/change_room_price'); ?>
														        					<input type="hidden" name="room_type" value="super_deluxe">
														        					<div class="input-group mb-2">
																				        <div class="input-group-prepend">
																				          <div class="input-group-text">P</div>
																				        </div>
														        							<input type="number" name="price_per_hour" value="<?php echo $sd_price[0]->price_per_hour; ?>" class="form-control" required>
																				    </div> 
														        			</td>
											        					</tr>
											        				</table>
									        							<div class="pull-right">
																		    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											       								<button type="submit" class="btn btn-primary">Save changes</button>
																	    </div>
																			    </form>
											        			</div>
											        		</div>
											     		</div>
											   		</div>
										  		</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>