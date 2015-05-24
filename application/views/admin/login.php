	<body>
		<center>
		<h1>Writers Login</h1>
			<?php echo $home_image?>
			<div class="errors">
				<?php echo validation_errors()?>
				<?php (isset($message)) ? print $message : ''; ?>
			</div>
			<div id="login-form">
			<?php echo form_open('login/pass'); ?>
		
			Email: <br/>
			<input type="text" name="email" /><br />
		
			Password: <br />
			<input type="text" name="password" />
			<input type="submit" value="Login" name="submit"/>
			<div class="remember"> <p>Remember?
			<input name="remember" <?php (isset($_POST['remember'])) ? print "checked" : ""; ?> type="checkbox" value="1"></p>
			</div>
			</form>
			</div>
		</center>
		</div>
	</body>
</html>