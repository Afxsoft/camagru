<div class="center">
	<form action="index.php?page=user_create&action=set" method="post" class="form_style">
		<h1>
			Create an account
		</h1>

		<label>
			<span>Login :</span>
			<input  type="text" name="login" required />
		</label>
		<label>
			<span>Mot de passe :</span>
			<input  type="password" name="passwd" required />
		</label>
		<label>
			<span>Email :</span>
			<input type="email" name="email" value="" required>
		</label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
	</form>
</div>
