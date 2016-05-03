<div class="center">
    <form action="index.php?page=login&action=post" method="post" class="form_style">
        <h1>
            Connexion
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
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
        <br>
        <label>
            <span>&nbsp;</span>
            <a href="index.php?page=user_recovery" title="Mot de passe oublier">Mot de passe oublier</a>
        </label>
    </form>
</div>
