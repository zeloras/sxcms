<div class="account-container stacked">
	<div class="content clearfix">
		
		<form action="/admin/auth" method="post">
                    <input type="hidden" name="submit_this_form" value="1">
			<h1><?=__("Sign in")?></h1>		
			
			<div class="login-fields">
                            <?if (isset($Errors)) {?>
                                <p style="color: #009900"><?=__("Login or password wrong")?></p>		
                            <?}?>
				<div class="field">
					<label for="username"><?=__("username")?>:</label>
					<input type="text" id="username" name="username" value="" placeholder="<?=__("username")?>" class="login username-field">
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password"><?=__("password")?>:</label>
					<input type="password" id="password" name="password" value="" placeholder="<?=__("password")?>" class="login password-field">
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="remember" name="remember" type="checkbox" class="field login-checkbox" value="1" tabindex="4">
					<label class="choice" for="Field"><?=__("Keep me signed in")?></label>
				</span>
									
				<button class="button btn btn-warning btn-large"><?=__("Sign In")?></button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div>