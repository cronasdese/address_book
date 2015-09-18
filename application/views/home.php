<!DOCTYPE html>
<html>
	<title><?php echo $title; ?></title>
		<?php $this->load->helper('url') ?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href= "<?php echo base_url('assets/css/bootstrap-responsive.css');?>"  >
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" >
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home.css'); ?>">
		<script src ="<?php echo base_url('assets/js/jquery-2.1.4.min.js');?>"></script>
		<script src ="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>	

		<script>

			$(document).on("click", ".open-UpdateModal", function () {
			     var firstname = $(this).data('firstname');
			     var lastname = $(this).data('lastname');
			     var contactnumber = $(this).data('contactnumber');
			     var address = $(this).data('address');
			     var emailaddress = $(this).data('emailaddress');
			     var id = $(this).data('id');
			     var picture = $(this).data('picture');

			     $(".modal-body #id").val( id );
			     $(".modal-body #firstname").val( firstname );
			     $(".modal-body #lastname").val( lastname );
			     $(".modal-body #contactnumber").val( contactnumber );
			     $(".modal-body #address").val( address );
			     $(".modal-body #emailaddress").val( emailaddress );
			     $(".modal-body #picture").val( picture );
			});

			$(document).on("click", ".open-DeleteModal", function () {
			     var id = $(this).data('id');
			     
			     $(".modal-footer #id").val( id );
			});
		</script>
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
		      <a class="navbar-brand" href="<?php echo base_url(); ?>">Address Book</a>
		    </div>

		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <form class="navbar-form navbar-left" method="GET" action="<?php echo base_url('Contacts/search'); ?>" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" name="search" id="search" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default" name="action">Search</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#" data-toggle="modal" data-target="#addModal">Add Contacts</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="container">
			<?php
				if($err == TRUE){
					echo'<div class="panel panel-default">
						<div class="panel-heading lead">
							Error
						</div>
						<div class="panel-body">
							Adding/updating contact failed.
						</div>
					</div>';
				}
				if(is_array($contacts_info) || is_object($contacts_info)){
					foreach($contacts_info as $object){
						echo '<div class="panel panel-default">
						<div class="panel-heading lead">
						  	<img src="'. base_url($object->picture) .'" width="60px" height="60px">
						  	&nbsp;&nbsp;' . $object->last_name . ', ' . $object->first_name .'
						  	<button type="button" class="open-DeleteModal btn btn-default pull-right" data-toggle="modal" data-target="#deleteModal" data-id="'. $object->id .'">Delete</button>
						  	<button type="button" class="open-UpdateModal btn btn-primary pull-right" data-toggle="modal" data-target="#updateModal" data-id="'. $object->id .'" data-firstname="'. $object->first_name .'" data-lastname="'. $object->last_name .'" data-contactnumber="'. $object->contact_number .'" data-address="'. $object->address .'" data-emailaddress="'. $object->email_address .'" data-picture="'. $object->picture .'">Update</button>
						  </div>
						  <div class="panel-body">' .
						  	$object->contact_number . '</br>' .
						    $object->address . '</br>' .
						    $object->email_address .
						  '</div>
						</div>';
					}
				}
				else{
					echo'<div class="panel panel-default">
						<div class="panel-heading lead">
							Error
						</div>
						<div class="panel-body">
							Contact does not exist.
						</div>
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
						<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('Contacts/addcontact'); ?>" enctype="multipart/form-data">
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
						      <input type="text" class="form-control" name="inputEmailAddress" placeholder="Email Address">
						    </div>
						    <div class="form-group">
						    	<label for="usr">Picture:</label>
						    	<input type="file" class="form-control" name="userfile"></br>
						    </div>
						    <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					          <button type="submit" class="btn btn-primary" name="action">Add</button>
					        </div>
						</form>
				    </div>
		        </div>
		      </div>
		    </div>
		</div>

		<div class="modal fade" id="updateModal" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Update Contact</h4>
		        </div>
		        <div class="modal-body">
		            <div>
						<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('Contacts/update'); ?>" enctype="multipart/form-data">
							<div class="form-group hidden">
						      <label for="usr">ID</label>
						      <input type="text" class="form-control" name="inputID" id="id">
						    </div>
						    <div class="form-group">
						      <label for="usr">First Name</label>
						      <input type="text" class="form-control" name="inputFirstName" id="firstname">
						    </div>
						    <div class="form-group">
						      <label for="usr">Last Name</label>
						      <input type="text" class="form-control" name="inputLastName" id="lastname">
						    </div>
						    <div class="form-group">
						      <label for="usr">Contact Number</label>
						      <input type="text" class="form-control" name="inputContactNumber" id="contactnumber">
						    </div>
						    <div class="form-group">
						      <label for="usr">Address:</label>
						      <input type="text" class="form-control" name="inputAddress" id="address">
						    </div>
						    <div class="form-group">
						      <label for="usr">Email Address:</label>
						      <input type="text" class="form-control" name="inputEmailAddress" id="emailaddress">
						    </div>
						    <div class="form-group">
						    	<label for="usr">Picture:</label>
						    	<input type="file" class="form-control" name="userfile" id="picture"></br>
						    </div>
						    <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					          <button type="submit" class="btn btn-primary" name="action">Update</button>
					        </div>
						</form>
				    </div>	
		        </div>
		      </div>
		    </div>
		</div>

		<div class="modal fade" id="deleteModal" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Are you sure you want to delete this contact?</h4>
		        </div>
					<form class="form-horizontal" role="form" method="GET" action="<?php echo base_url('Contacts/delete'); ?>">
					    <div class="modal-footer">
					    	<div class="form-group hidden">
						      <label for="usr">ID</label>
						      <input type="text" class="form-control" name="inputID" id="id">
						    </div>
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				          <button type="submit" class="btn btn-primary" name="action">Delete</button>
				        </div>
					</form>
		        </div>
		      </div>
		    </div>
		</div>
	</body>
</html>