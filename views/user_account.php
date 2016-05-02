<div class="center">
	<form action="index.php?page=user_account&action=set" method="post" class="form_style">
		<h1>
			Account managment
		</h1>
		<label>
			<span>First name :</span>
			<input type="text" name="first_name" value="" required>
		</label>
		<label>
			<span>Last name :</span>
			<input type="text" name="last_name" value="" required>
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
			<span>Billing address :</span>
			<input type="text" name="billing" value="" required>
		</label>
		<label>
			<span>Shipping address :</span>
			<input type="text" name="shipping" value="" required>
		</label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
	</form>
</div>
<div class="center">
    <form action="index.php?page=user_account&action=delete_user" method="post" class="form_style">
        <h1 style="text-align: center">
            Delete the account
        </h1>
        <label>
            <span>Login :</span>
            <input  type="text" name="login" placeholder="Login" required/>
        </label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
    </form>

</div>
