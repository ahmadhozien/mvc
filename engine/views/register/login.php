<?php
  // setting the page's title
  $this->set_site_title('Login');

  // start the head are
  $this->start('head');
?>
<!-- meta tags & additional style  -->
<meta content="test description"/>


<?php
  // end the head area
  $this->end();

  // start the body area
  $this->start('body');
?>
<!-- body content -->
<div class="container">
	<div class="col-md-6 mt-5 offset-3 alert alert-secondary">
		<div class="p-2 text-center">
			<h3>Login</h3>
			<small>Welcome to MVC login page</small>
		</div>
		<form action="" method="post">
			<div class="form-group">
				<label for="mail">E-mail</label>
				<input type="text" placeholder="example@expmle.com" class="col-12 form-cotrol pt-2 pb-2" name="email" id="mail">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" placeholder="your password" class="col-12 form-cotrol pt-2 pb-2" name="password" id="password">
			</div>
			<div class="form-group">
				<input type="checkbox" class="form-cotrol" name="remember" id="remember">
				<label for="remember">Remember me</label>
			</div>
			<div class="text-center form-group">
				<button class="btn btn-primary">Login</button>
			</div>
			<div class="form-group">
				Don't have an account? 
				<a href="register">Register</a>
			</div>
		</form>
	</div>
</div>
<!-- end body content  -->
<?php
$this->end();
