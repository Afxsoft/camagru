<footer>
    <div class="cb">
    </div>
    <div class="copyright">
        ©  Camagru - Tous droits réservés. <a href="#">Mentions Légales</a> | <a href="#">Données personnelles</a> | <a href="#">Politique de Cookies</a><br>
</footer>
</div>
</div>
<script src="js/script.js"></script>
<?php
if ($currentPage == 'index' && !empty($_SESSION['loggued_on_user'])){?>
    <script src="js/webcam.js"></script>
<?php }?>
</body>
</html>