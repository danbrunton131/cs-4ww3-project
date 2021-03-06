<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Transit Rating - Submit a System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="static/base.css">
	<link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css">
	<!-- need this sheet for hamburger icon for mobile nav -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	
	<?php include("includes/header.php"); ?>
	<?php 
		$page_id = 'submit';
		include("includes/navbar.php"); 
	?>

	<?php include("includes/login-modal.php"); ?>

	<!-- Main page content -->
	<section>
		<?php if (isset($_SESSION["username"])) : ?>
			<h3>Add a New Transit System</h3>
			<form action="submission_post.php" method="POST" class="header-buffer" enctype="multipart/form-data">
				<div class="form-group row">
					<label for="obj_name" class="col-md-2 col-form-label">Name</label>
					<input type="text" class="form-control col-md-10" name="obj_name" id="obj_name" required>
				</div>
				<div class="form-group row">
					<label for="obj_desc" class="col-md-2 col-form-label">Description</label>
					<input type="text" class="form-control col-md-10" name="obj_desc" id="obj_desc">
				</div>
				<!-- Use a select to provide transit options, these could be pulled dynamically in future.
				Actually what I want is to have some sort of autocomplete location search from google maps API. -->
				<div class="form-group row">
					<label for="obj_type" class="col-md-2 col-form-label">Type</label>
					<select class="form-control col-md-10" name="obj_type" id="obj_type">
						<option>Train</option>
						<option>Bus</option>
						<option>Tram</option>
						<option>Subway</option>
						<option>Ferry</option>
					</select>
				</div>
				<div class="form-group row">
					<label for="obj_lat" class="col-md-2 col-form-label">Latitude</label>
					<input type="number" step="any" class="form-control col-md-7" name="obj_lat" id="obj_lat" required>
				</div>
				<div class="form-group row">
					<label for="obj_long" class="col-md-2 col-form-label">Longitude</label>
					<input type="number" step="any" class="form-control col-md-7" name="obj_long" id="obj_long" required>
				</div>
				<div class="form-group row">
					<label for="obj_city" class="col-md-2 col-form-label">City</label>
					<input type="text" class="form-control col-md-7" name="obj_city" id="obj_city">
					<button type="button" data-toggle="modal" data-target="#modal_location" class="btn btn-secondary col-md-2 offset-md-1" onclick="navigator.geolocation.getCurrentPosition(LoadLocation);">Find Near Me</button>
				</div>
				<!-- These could also be pulled dynamically -->
				<div class="form-group row">
					<label for="obj_province" class="col-md-2 col-form-label">Province</label>
					<select class="form-control col-md-10" name="obj_province" id="obj_province">
						<option>AB</option>
						<option>BC</option>
						<option>MB</option>
						<option>NB</option>
						<option>NL</option>
						<option>NS</option>
						<option>NT</option>
						<option>NU</option>
						<option>ON</option>
						<option>PE</option>
						<option>QC</option>
						<option>SK</option>
						<option>YT</option>
					</select>
				</div>
				<!-- URL of external information about the transit line -->
				<div class="form-group row">
					<label for="obj_url" class="col-md-2 col-form-label">External URL</label>
					<input type="url" class="form-control col-md-10" name="obj_url" id="obj_url" pattern="https?://.+">
				</div>
				<!-- Image upload -->
				<div class="form-group row">
					<label for="obj_img" class="col-md-2 col-form-label">Upload Image</label>
					<input type="file" class="form-control-file col-md-10" name="obj_img" id="obj_img" accept=".jpg, .png">
				</div>
				<!-- Video upload -->
				<div class="form-group row">
					<label for="obj_vid" class="col-md-2 col-form-label">Upload Video</label>
					<input type="file" class="form-control-file col-md-10" name="obj_vid" id="obj_vid" accept=".mp4, .webm">
				</div>
				<button type="submit" class="btn btn-secondary">Submit</button>
			</form>
		<?php endif; ?>
		<?php if (!isset($_SESSION["username"])) : ?>
			<p>Only logged in users can submit a new transit system. Please log in or <a href="registration.php">register</a> to proceed.</p>
		<?php endif; ?>
	</section>

	<div class="modal" id="modal_location" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Location Selection</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="map" class="map"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<h5>Transit Rating</h5>
		<h6>Helping You Get Places</h6>
	</footer>

	<script src="static/submission.js"></script>

	<!-- jQuery/Bootstrap scripts -->
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- Google Maps API -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAW0YtpSWfJsdHE5dxZtwUx2TBhOlnM0r0&libraries=places&callback=placesInit"
    async defer></script>
</body>

</html>