<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/grocery_crud/themes/bootstrap/css/bootstrap.min.css"); ?>">
  <script src="<?php echo base_url("/assets/grocery_crud/themes/bootstrap/js/bootstrap.min.js"); ?>"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <title>Spa Resource Management System Prototype</title>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('')?>">SRMS Prototype</a>
			</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href='<?php echo site_url('')?>'>Home</a></li>
	    	    	<li><a href='<?php echo site_url('staff')?>'>Staff</a></li>
					<li><a href='<?php echo site_url('')?>'>Qualifications</a></li>
					<li><a href='<?php echo site_url('')?>'>Therapist Qualif.</a></li>
					<li><a href='<?php echo site_url('pages/equipment')?>'>Equipment</a></li>
	    	    	<li><a href='<?php echo site_url('pages/therapyEquip')?>'>Therapy Equipment</a></li>
		    	    <li><a href='<?php echo site_url('pages/therapy')?>'>Therapy</a></li>
    		    	<li><a href='<?php echo site_url('pages/therapySession')?>'>Therapy Session</a></li>
	    		    <li><a href='<?php echo site_url('pages/room')?>'>Room</a></li>
	        	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?php echo site_url('')?>'>to be set</a></li>
				</ul>
			</div>	
		</nav>

