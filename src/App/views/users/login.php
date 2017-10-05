<h1>Connexion</h1>

<form action="" method="post">
    <?= $form->input('login', 'Identifiant', ['placeholder' => 'Pseudo ou e-mail']); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->submit("Se connecter"); ?>
</form>

<p>Pas de compte ? Inscris-toi <a href="<?= $this->url('users.register') ?>">ici</a>.</p>