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
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href='<?php echo site_url('')?>'>Home</a></li>
	    	    	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Staff<span class="caret"></span></a>
	    	    		<ul class="dropdown-menu">
	    	    			<li><a href="<?php echo site_url('staff/staff')?>">All Staff</a></li>
	    	    			<li><a href="<?php echo site_url('staff/staff/add')?>">Add New Staff</a></li>
	    	    		</ul>
	    	    	</li>
					<li><a href='<?php echo site_url('')?>'>3</a></li>
					<li><a href='<?php echo site_url('')?>'>4</a></li>
					<li><a href='<?php echo site_url('')?>'>5</a></li>
	    	    	<li><a href='<?php echo site_url('')?>'>6</a></li>
		    	    <li><a href='<?php echo site_url('')?>'>7</a></li>
    		    	<li><a href='<?php echo site_url('')?>'>8</a></li>
	    		    <li><a href='<?php echo site_url('')?>'>9</a></li>
	        	</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?php echo site_url('')?>'>to be set <!--For user login/log out--></a></li>
				</ul>
				
			</div>	
		</nav>

