
<link rel="Stylesheet" href="assets/css/form-style.css" />

<div style="display: none;">
		<div id="dialog" title="Error">
			<p>Hasła muszą być takie same</p>
		</div>
</div>

<div class="container" style="height: 80%;">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">

								<a href="#" class="active" id="login-form-link">Login</a>

								<a href="#" id="register-form-link">Register</a>

						</div>
						<hr>
					</div>
					<div class="panel-body">
						<p style="text-align: center; color: red;">
							<?php 
								if (isset($_GET['err'])) {

									switch ($_GET['err']) {
										case 'p':
											echo 'Hasła nie są identyczne.';
											break;

										case 'u':
											echo 'Użytkownik o tej nazwie już istnieje.';
											break;

										case 'n':
											echo 'Nieprawidłowy login lub hasło.';
											break;
										
										default:
											# code...
											break;
									}
								}

							?>
						</p>
						<p style="text-align: center; color: green;">
							<?php
								if (isset($_GET['reg'])) 
									echo "Konto zostało utworzone, zaloguj się.";
							?>
						</p>
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="actions/login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="hidden" name="l-action" value="login">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									
								</form>
								<form id="register-form" action="actions/login.php" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="r-password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="hidden" name="l-action" value="register">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function() {

		    $('#login-form-link').click(function(e) {
				$("#login-form").delay(100).fadeIn(100);
		 		$("#register-form").fadeOut(100);
				$('#register-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#register-form-link').click(function(e) {
				$("#register-form").delay(100).fadeIn(100);
		 		$("#login-form").fadeOut(100);
				$('#login-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});

		});

		$('#register-submit').click(function(e) {
			if ($('#r-password').val() != $('#confirm-password').val()) {
						err = 1
				    	$( "#dialog" ).dialog({	 // KOMPONENT JQUERY UI - DIALOG, OKNO DIALOGOWE
				    		autoOpen: true,
				    		width: 400,
				    		buttons: [
				    		{
				    			text: "Ok",
				    			click: function() {
				    				$( this ).dialog( "close" );
				    			}
				    		},
				    		{
				    			text: "Cancel",
				    			click: function() {
				    				$( this ).dialog( "close" );
				    			}
				    		}
				    		]
				    	});
				    }
		});

	</script>