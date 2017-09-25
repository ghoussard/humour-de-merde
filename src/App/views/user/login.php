<h1>Connexion</h1>

<form action="" method="post">
    <?= $form->input('login', 'Identifiant', ['placeholder' => 'Pseudo ou e-mail']); ?>
    <?= $form->input('login', 'Identifiant', ['type' => 'password']); ?>
    <?= $form->submit("Se connecter"); ?>
</form>