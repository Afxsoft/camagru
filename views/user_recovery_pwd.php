<div class="center">
	<form action="index.php?page=user_recovery_pwd&action=set&token=<?php echo $_GET['token']?>" method="post" class="form_style">
		<h1>
			Nouveau mot de passe
		</h1>
		<label>
			<span>Mot de passe :</span>
			<input  type="password" name="passwd" required />
		</label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
	</form>
</div>
