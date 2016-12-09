<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/grocery_crud/themes/bootstrap/css/bootstrap.min.css"); ?>">
  	<script src="<?php echo base_url("/assets/grocery_crud/themes/bootstrap/js/bootstrap.min.js"); ?>"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!--	<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?> 
	-->
</head>
<body>

	<h1>Staff</h1>
    <div>
		<?php echo $output; ?>
	</div>
