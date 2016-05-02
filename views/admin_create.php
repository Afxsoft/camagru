<div class="center">
    <form action="index.php?page=admin_create&action=post" method="post" class="form_style">
        <h1>
            Creation of an admin account
        </h1>
        <label>
            <span>Login :</span>
            <input  type="text" name="login" placeholder="Votre login" required/>
        </label>

        <label>
            <span>Mot de passe :</span>
            <input  type="password" name="passwd" required />
        </label>

		<label>
			<span>First name :</span>
			<input  type="text" name="first_name" placeholder="First name" required/>
		</label>

		<label>
			<span>Last name :</span>
			<input  type="text" name="last_name" placeholder="Last name" required/>
		</label>

        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
    </form>
</div>
