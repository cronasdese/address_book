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
		<script src ="<?php echo base_url('assets/js/parsely.min.js');?>"></script>
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
					echo '<p class="lead">Duplicate contact seen</p>';
					if(is_array($contacts_info) || is_object($contacts_info)){
						foreach($contacts_info as $object){
							echo '<div class="panel panel-danger">
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
				}
				else{
					if($add == TRUE){
						echo '<p class="lead">Added/Updated Contact</p>';
						if(is_array($added_contact) || is_object($added_contact)){
							foreach($added_contact as $object){
								echo '<div class="panel panel-success">
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
					}
					echo '<div class="panel">
						<form method="GET" action="'. base_url('Contacts/letterSearch').'">
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonA">A</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonB">B</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonC">C</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonD">D</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonE">E</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonF">F</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonG">G</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonH">H</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonI">I</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonJ">J</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonK">K</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonL">L</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonM">M</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonN">N</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonO">O</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonP">P</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonQ">Q</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonR">R</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonS">S</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonT">T</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonU">U</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonV">V</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonW">W</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonX">X</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonY">Y</button>
							<button type="submit" class="btn btn-default btn-sm" name="action" value="buttonZ">Z</button>
						</form>
					</div>';
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
						<form class="form-horizontal" role="form" method="POST" id="add-form" action="<?php echo base_url('Contacts/addcontact'); ?>" enctype="multipart/form-data" data-parsely-validate>
						    <div class="form-group">
						      <label for="usr">First Name</label>
						      <input type="text" class="form-control" name="inputFirstName" placeholder="First Name" maxlength="35" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Last Name</label>
						      <input type="text" class="form-control" name="inputLastName" placeholder="Last Name" maxlength="35" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Contact Number</label>
						      <input type="number" class="form-control" name="inputContactNumber" placeholder="Contact Number" min="9000000000" max="9999999999" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Address:</label>
						      <input type="text" class="form-control" name="inputAddress" placeholder="Address" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Email Address:</label>
						      <input type="email" class="form-control" name="inputEmailAddress" placeholder="Email Address" required />
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
						<form class="form-horizontal" role="form" method="POST" id="update-form" action="<?php echo base_url('Contacts/update'); ?>" enctype="multipart/form-data" data-parsely-validate>
							<div class="form-group hidden">
						      <label for="usr">ID</label>
						      <input type="text" class="form-control" name="inputUpdateID" id="id">
						    </div>
						    <div class="form-group">
						      <label for="usr">First Name</label>
						      <input type="text" class="form-control" name="inputUpdateFirstName" id="firstname" maxlength="35" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Last Name</label>
						      <input type="text" class="form-control" name="inputUpdateLastName" id="lastname" maxlength="35" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Contact Number</label>
						      <input type="number" class="form-control" name="inputUpdateContactNumber" id="contactnumber" min="9000000000" max="9999999999" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Address:</label>
						      <input type="text" class="form-control" name="inputUpdateAddress" id="address" required />
						    </div>
						    <div class="form-group">
						      <label for="usr">Email Address:</label>
						      <input type="email" class="form-control" name="inputUpdateEmailAddress" id="emailaddress">
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