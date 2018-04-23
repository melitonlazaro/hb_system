<?php 
	$name = $this->session->userdata('name');
	echo $name;
 ?>

 <a href="<?php echo base_url();?>Main/logout">Logout</a>