<div class="widget">
	<form action="/user/doCreate" method="post" class="col-6">
		<div class="form-group">
	  	<input id="username" name="username" type="text" class="form-control" placeholder="Username" required>
		</div>
		<div class="form-group">
			<input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
		</div>
        <div class="form-group">
            <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input id="email" name="email" type="text" class="form-control" placeholder="E-Mail">
        </div>
		<button type="submit" name="send" class="btn btn-primary">Register</button>
	</form>
</div>
