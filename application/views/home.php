<!DOCTYPE html>
<html>
	<title><?php echo $title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href= "assets/css/bootstrap-responsive.css" rel="stylesheet" >
		<link rel= "stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" >
		<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>
		<script src= "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" ></script>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
	</title>
	<body>
		<nav class="navbar navbar-fixed-top navbar-default">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Address Book</a>
		    </div>

		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <form class="navbar-form navbar-left" action="application/controllers/Welcome/search" method="post" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Search</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#" data-toggle="modal" data-target="#addModal">Add Contacts</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="container">
			<?php
				foreach($contacts_info as $object){
					echo '<div class="panel panel-default">
					<div class="panel-heading lead">
						<p class="hidden">' . $object->id . '</p>
					  	<img src="data:image/jpeg;base64,'.base64_encode($object->picture).'" width="60px" height="60px">
					  	&nbsp;&nbsp;'. $object->last_name . ', ' . $object->first_name . 
					  	'<button type="submit" class="btn btn-default pull-right">Delete</button>
					  	<button type="submit" class="btn btn-primary pull-right">Update</button>
					  </div>
					  <div class="panel-body">' .
					  	$object->contact_number . '</br>' .
					    $object->address . '</br>' .
					    $object->email_address .
					  '</div>
					</div>';
				}
			?>
		</div>

		<div class="modal fade" id="addModal" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Add Contact</h4>
		        </div>
		        <div class="modal-body">
		            <div>
						<form class="form-horizontal" role="form" actionmethod="post">
						    <div class="form-group">
						      <label for="usr">First Name</label>
						      <input type="text" class="form-control" name="inputFirstName" placeholder="First Name">
						    </div>
						    <div class="form-group">
						      <label for="usr">Last Name</label>
						      <input type="text" class="form-control" name="inputLastName" placeholder="Last Name">
						    </div>
						    <div class="form-group">
						      <label for="usr">Contact Number</label>
						      <input type="text" class="form-control" name="inputContactNumber" placeholder="Contact Number">
						    </div>
						    <div class="form-group">
						      <label for="usr">Address:</label>
						      <input type="text" class="form-control" name="inputAddress" placeholder="Address">
						    </div>
						    <div class="form-group">
						      <label for="usr">Email Address:</label>
						      <input type="text" class="form-control" name="inputEmailAddress" placeholder="Contact Number">
						    </div>
						    <div class="form-group">
						    	<label for="usr">Picture:</label>
						    	<input type="file" class="form-control" name="inputPicture"></br>
						    </div>
						</form>
				    </div>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
		        </div>
		      </div>
		    </div>
		</div>
	</body>
</html>